<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\utils\routes;


class RouterDuplicationException extends RouterException {

  public function __construct(
    string $message = "Route URI, cannot be added. It is already Existed", 
    int $code = 0, 
    \Throwable|null $previous = null
  ) {
    parent::__construct($message, $code, $previous);
    header("HTTP/1.0 500 Internal Server Error");
    
    // http_response_code(404);
  }
  
}