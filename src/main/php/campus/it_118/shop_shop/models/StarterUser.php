<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

class StarterUser extends User {

  public function __construct(
    ?string $id = null
  ) {
    parent::__construct($id);
    
    echo "<pre>";
    var_dump($this);
    echo "</pre>";
    echo "<> " . \spl_object_id($this) . "</br>";
    echo "<> " . \spl_object_hash($this) . "</br>";
  }

  public static function what(): void {
    echo "what...";
  }
}