<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\models\IRenderer;
use campus\it_118\shop_shop\models\renders\CSS;
use campus\it_118\shop_shop\utils\Status;

abstract class Layout extends ObjectI implements IRenderer {
  
  

  public function __construct(
    public ?string $title = null,
    protected ?string $outlet = null,
    public ?CSS $srcCSS = null
  ) { 
    parent::__construct();

    $this->title ??= Status::unknown()->SYMBOL;

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

  public function setCSS( ?CSS $srcCSS ): self {

    $this->srcCSS = $srcCSS;
    return $this;
  }

  #[\Override]
  public abstract function render(?CSS $css = null): string;

}