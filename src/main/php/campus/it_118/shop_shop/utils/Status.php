<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\utils;

final class Status
{
    private static self $PENDING;
    private static self $APPROVED;

    private static self $UNKNOWN;

    private function __construct(
        public readonly int $CODE,
        public readonly string $SYMBOL,
        public readonly string $DESCRIPTION = "N/a"
    ) { }


    public static function pending(): self {
      
      return self::$PENDING ??= new self(1, "PND", "[PENDING...]");
    }

    public static function approved(): self {

      return self::$APPROVED ??= new self(2, "APD", "[APPROVED...]");
    }

    public static function unknown(): self {

      return self::$UNKNOWN ??= new self(4, "N/a", "[UNKNOWN...]");
    }


    //REM: Optional: Prevent cloning and unserialization
    private function __clone() {}
    public function __wakeup() { 
      throw new \Exception("Cannot unserialize Status"); 
    }
}
