<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

class StarterUser extends User {

  public function __construct(

  ) {
    parent::__construct();
  }

  public static function what(): void {
    echo "what...";
  }
}