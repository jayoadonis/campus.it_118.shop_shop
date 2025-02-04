<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\controllers\Controller;

abstract class View extends ObjectI implements IRenderer {

  public function __construct(
    protected Controller $controller
  ) {
    parent::__construct();
  }
}