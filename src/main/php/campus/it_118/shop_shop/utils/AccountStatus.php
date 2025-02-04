<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\utils;
use campus\it_118\shop_shop\models\ObjectI;


final class AccountStatus extends ObjectI {

  private static self $UNKNOWN;
  private static self $STARTER;


  private function __construct(
    public readonly int $CODE,
    public readonly string $VALUE,
    public readonly string $DESCRIPTION
  ) {

  }

  public static function starter(): self {

    return self::$STARTER ??= new self(1, "STARTER", "[FREE ACCOUNT]");
  }

  public static function unknown(): self {

    return self::$UNKNOWN ??= new self(-1, "N/a", "[UNKNOWN ACCOUNT STATUS/TYPE]");
  }

  #[\Override]
  public function __toString(): string {

    return strtr(
      "<toString>[CODE=<code>, VALUE='<value>']",
      [
        "<toString>" => parent::__toString(),
        "<code>" => $this->CODE,
        "<value>" => $this->VALUE
      ]
    );
  }

}