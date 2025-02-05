<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers\routes;

use campus\it_118\shop_shop\models\ObjectI;
use campus\it_118\shop_shop\utils\routes\RouterDuplicationException;
use campus\it_118\shop_shop\controllers\Controller;
use campus\it_118\shop_shop\models\Layout;

class RouteData extends ObjectI
{
  /**
   * @param string $METHOD
   * @param string $PATH
   * @param callable|array|null $HANDLER
   * @param ?array<mixed|null> $params
   */
  public function __construct(
    public readonly string $METHOD,
    public readonly string $PATH,
    public readonly mixed $HANDLER,
    public ?array $params
  ) {}

  #[\Override]
  public function __toString(): string
  {

    if (is_callable($this->HANDLER)) {
      $handler = new \ReflectionFunction($this->HANDLER ?: function () {});
    } elseif (is_array($this->HANDLER)) {
      $handler = implode(", ", array_map(static fn($value) => strval($value), $this->HANDLER));
    } elseif (is_null($this->HANDLER)) {
      $handler = "NULL";
    } else {
      $handler = "Invalid type";
    }

    return strtr(
      "<parentToString>[METHOD='<m>', PATH='<p>', params=[<params>], HANDLER=<handler>]",
      [
        "<parentToString>" => parent::__toString(),
        "<m>" => $this->METHOD,
        "<p>" => $this->PATH,
        "<params>" => implode(", ", array_map(
          function ($key, $value) {

            return "$key='$value'";
          },
          array_keys($this->params),
          $this->params
        )),
        "<handler>" => $handler
      ]
    );
  }
}


class RouterVI extends ObjectI
{

  /**
   * @var array< string, array<string, RouteData> > 
   */
  private array $routes = [];

  public function __construct(
    private readonly Layout $LAYOUT
  ) {}

  public function add(
    string $method,
    string $path,
    callable|array|null $handler
  ): bool {

    if (! isset($this->routes[$method][$path])) {
      $this->routes[$method][$path] = new RouteData(
        $method,
        $path,
        $handler,
        []
      );
      return true;
    }

    return false;
  }

  public function getRouteData(
    string $method,
    string $requestURI
  ): ?RouteData {

    $method = strtoupper($method);

    foreach ($this->routes[$method] ?? [] as $path => $routeData) {

      $pathPattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $path);

      $pathPattern = "#^" . $pathPattern . "$#";
      $paramValues = [];

      if (preg_match($pathPattern, $requestURI, $paramValues)) {

        array_shift($paramValues);

        $paramKeys = [];

        preg_match_all(
          '/\{(\w+)\}/',
          $path,
          $paramKeys
        );

        $params = array_combine(
          $paramKeys[1],
          $paramValues
        ) ?: [];

        $routeData->params = $params;

        return $routeData;
      }
    }

    return null;
  }

  public function dispatch(
    // string $method,
    // string $requestURI
  ): mixed
  {

    $routeData = $this->getRouteData(
      $_SERVER["REQUEST_METHOD"],
      $this->getCurrentURI()
    );

    if (!$routeData) {
      // throw new \Exception("...");
      // echo "404 Not Found!";

      // http_response_code(404);
      
      try {
        $this->setPageNotFound(function () {
          return <<<HTML
          <div id="page-not-found">
            <h1>Page Not Found</h1>
          </div>
          HTML;
        });
      }
      catch( \Exception $ex ) {

      }

      header("location: /404", false, 404);
      $routeData = $this->getRouteData(
        "GET",
        "/404"
      );
    }

    $handler = $routeData->HANDLER;

    if (is_callable($handler)) {
        echo $this->LAYOUT->setOutlet( call_user_func($handler, $routeData) )->render();
    } elseif (is_array($handler) && count($handler) >= 1) {

      [$class] = $handler;

      if (class_exists($class)) {

        if (is_subclass_of($class, Controller::class)) {

          $controller = new $class($this->LAYOUT, $routeData);

          if ($controller instanceof Controller) {

            echo $this->LAYOUT->setOutlet($controller->render())->render();
          }

          return true;
        }

        [$class, $method] = $handler;

        if (method_exists($class, $method))
          return call_user_func([new $class, $method], $routeData);
      }
    }

    throw new \InvalidArgumentException("Invalid handler type");
  }

  public function getCurrentURI(): string
  {
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    self::normalizedURI($uri);

    return $uri;
  }

  protected static function normalizedURI(string &$uri): void
  {
    $uri = "/" . \rtrim(\ltrim($uri, " \n\r\t/"), " \n\r\t/");
  }

  /**
   * Summary of get
   * @param string $path
   * @param callable|array|null $handler
   * @throws \campus\it_118\shop_shop\utils\routes\RouterDuplicationException
   * @return void
   */
  public function get(
    string $path,
    callable|array|null $handler
  ): void {

    if (! $this->add("GET", $path, $handler))
      throw new RouterDuplicationException($path);
  }

  public function post(
    string $path,
    callable|array|null $handler
  ): void {

    if (! $this->add("POST", $path, $handler))
      throw new RouterDuplicationException($path);
  }

  public function setPageNotFound(
    callable|array|null $handler
  ): void {

    $this->get("/404", $handler);
  }


  /**
   * Summary of getRoutes
   * @return array< string, array< string, RouteData> >
   */
  public function getRoutes(): array
  {

    //REM: Shallow copy.
    // return $this->routes;

    //REM: Shallow clone.
    return array_map(
      static fn($methods) => array_map(
        static fn($path) => clone $path,
        $methods
      ),
      $this->routes
    );
  }
}
