<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\utils\AccountStatus;

class StarterUser extends User {

  public function __construct(
    ?string $id = null,
    ?string $userName = null
  ) {

    parent::__construct($id, $userName, AccountStatus::starter());
    
    // echo "<pre>";
    // var_dump($this);
    // echo "</pre>";
    // echo "<> " . \spl_object_id($this) . "</br>";
    // echo "<> " . \spl_object_hash($this) . "</br>";
  }

  public static function what(): void {
    echo "what...";
  }
}