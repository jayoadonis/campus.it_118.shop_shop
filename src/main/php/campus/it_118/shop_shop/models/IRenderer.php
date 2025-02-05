<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\models\renders\CSS;

interface IRenderer extends IEntity {

  public function render( ?CSS $css = null ): string;
}