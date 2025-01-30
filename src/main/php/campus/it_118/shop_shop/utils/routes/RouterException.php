<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\utils\routes;

class RouterException extends \Exception {


  public function __construct(
    string $message = "", 
    int $code = 0, 
    \Throwable $previous = null
  ) {
    parent::__construct($message, $code, $previous);
  }

  public final function __clone(): void {}
  public final function __wakeup(): void {}
}