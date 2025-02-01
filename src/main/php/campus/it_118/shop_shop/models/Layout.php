<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\models\IRenderer;

abstract class Layout extends ObjectI implements IRenderer {
  

  public function __construct(
    protected ?string $outlet = null
  ) {
    parent::__construct();
  }

  public function toString(): string {

    return strtr(
      "<cN>@<hC>",
      [
        "<cN>" => self::class,
        "<hC>" => sprintf("%08x", $this->hashCode() )
      ]
    );
  }

  public function setOutlet( ?string $outlet ): self {

    $this->outlet = $outlet;
    return $this;
  }

  #[\Override]
  public abstract function render(): string;

}