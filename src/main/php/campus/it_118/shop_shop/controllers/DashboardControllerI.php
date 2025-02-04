<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers;

use campus\it_118\shop_shop\controllers\routes\RouteData;
use campus\it_118\shop_shop\models\Layout;

class DashboardControllerI extends Controller {


  public function __construct(
    ?Layout $layout = null,
    RouteData $routeData
  ) {
    
    parent::__construct($layout, $routeData);

    $this->init();
  }

  private function init(): void {

    if($this->ROUTE_DATA->METHOD === "POST") {

      echo "METHOD POST</br>";
      //REM: Fetching...
    }
  }

  #[\Override]
  public function render(): string {

    \ob_start();
    ?>
    <div id="<?=$this->hashCode()?>">
      <h1><?=$this->LAYOUT->title?> ~ Dashboard Controller I</h1>
      <h3>::: <?=$this->ROUTE_DATA->params['verb']??"N/a"?></h3>
      <a href="/"><button>home...</button></a>
    </div>
    <?php

    return \ob_get_clean();
  }

}