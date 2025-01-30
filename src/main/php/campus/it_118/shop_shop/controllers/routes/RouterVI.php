<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers\routes;

use campus\it_118\shop_shop\models\ObjectI;
use campus\it_118\shop_shop\utils\routes\RouterDuplicationException;

class RouteData extends ObjectI 
{
    /**
     * @param string $METHOD
     * @param string $PATH
     * @param callable|array|null $HANDLER
     * @param mixed $params
     */
    public function __construct(
        public readonly string $METHOD,
        public readonly string $PATH,
        public readonly mixed $HANDLER,
        public array $params
    ) {
    }
}


class RouterVI extends ObjectI {

  /**
   * @var array<
   *  string, array<string, RouteData>
   * > 
   */
  private array $routes = [];

  public function __construct() {
   
  }

  public function add(
    string $method,
    string $path,
    callable|array|null $handler
  ): bool {

    if( ! isset($this->routes[$method][$path]) ) {
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

    foreach( $this->routes[$method] ?? [] as $path => $routeData ) {

      $pathPattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $path);
      
      $pathPattern = "#^".$pathPattern."$#";
      $paramValues = [];

      if( preg_match($pathPattern, $requestURI, $paramValues) ) {

        array_shift($paramValues);

        $paramKeys = [];

        preg_match_all(
          '/\{(\w+)\}/', $path, $paramKeys
        );

        $params = array_combine(
          $paramKeys[1], $paramValues
        ) ?: [];

        $routeData->params = $params;

        echo "<pre>";
        print_r($routeData);
        echo "</pre>";
        return $routeData;
      }
    }

    return null;
  }

  public function dispatch(
    // string $method,
    // string $requestURI
  ): mixed {

    $routeData = $this->getRouteData(
      $_SERVER["REQUEST_METHOD"], $this->getCurrentURI()
    );

    if( ! $routeData ) {
      http_response_code(404);
      echo "404 Not Found!";
      exit();
    }

    $handler = $routeData->HANDLER;

    if( is_callable($handler) ) {
      return call_user_func($handler, $routeData);
    }
    elseif(is_array($handler) && count($handler) === 2) {
      [$class, $method] = $handler;

      if( class_exists($class) && method_exists($class, $method) ) {
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
      $uri = "/".\rtrim(\ltrim($uri, " \n\r\t/"), " \n\r\t/");
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

    if( ! $this->add( "GET", $path, $handler ) ) 
      throw new RouterDuplicationException();
  }
}