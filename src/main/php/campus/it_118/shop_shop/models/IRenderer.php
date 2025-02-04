<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

interface IRenderer extends IEntity {


  public function render(): string;
}