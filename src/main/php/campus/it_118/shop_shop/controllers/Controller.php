<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers;

use campus\it_118\shop_shop\controllers\routes\RouteData;
use campus\it_118\shop_shop\models\IRenderer;
use campus\it_118\shop_shop\models\Layout;
use campus\it_118\shop_shop\models\ObjectI;
use campus\it_118\shop_shop\models\renders\CSS;

abstract class Controller extends ObjectI implements IRenderer {

  public function __construct( 
    public readonly ?Layout $LAYOUT,
    public readonly RouteData $ROUTE_DATA
  ) {
    parent::__construct();
  }
  public abstract function render(?CSS $css = null): string;
}