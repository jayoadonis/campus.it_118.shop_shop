<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers\routes;

use campus\it_118\shop_shop\models\ObjectI;

class RouteV0 extends ObjectI {
  
  /**
   * 
   * @var array<string,array<string,mixed>>
   */
  private array $routes;

  public function add( 
    string $method,
    string $path,
    callable|array $handler
  ): bool {

    if( ! isset($this->routes[$method][$path]) ) {

      $this->routes[$method][$path] = $handler;
      return true;
    }

    return false;
  }

  /**
   * 
   * 
   * @param string $method
   * @param string $path
   * @param callable|array $handler
   * @return array|callable|null 
   */
  public function set(
    string $method,
    string $path,
    callable|array $handler
  ): array|callable|null {
    
    /**
     * @var array|callable|null
     */
    $prevHandler = $this->routes[$method][$path] ?? null;

    $this->routes[$method][$path] = $handler;

    return $prevHandler;
  }

  public function getCurrentURI(): string {

    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    RouteV0::normalizedURI($uri);

    return $uri;
  }

  private static function normalizedURI( string &$uri ): void {

    $uri = \rtrim(\ltrim($uri, ' \n\r\t/'),  ' \n\r\t/') ?: '/';

    return;
  }

  public function dispatch(): void {

    echo "where....";
  }
}
