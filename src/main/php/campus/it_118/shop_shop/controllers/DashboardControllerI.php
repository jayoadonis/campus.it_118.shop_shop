<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\controllers;

use campus\it_118\shop_shop\controllers\routes\RouteData;
use campus\it_118\shop_shop\models\Layout;
use campus\it_118\shop_shop\models\renders\CSS;

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
  public function render(?CSS $css = null): string {

    // $this->LAYOUT->setCSS( new CSS(
    //   <<<CSS
    //   #title{ color: red; }
    //   CSS
    // ));

    $this->LAYOUT->setCSS( 
      $css
      ?? new CSS(
        __SHOP_SHOP_MAIN_REZ_DIR . "/css/dashboard_view.css"
      )
    );

    \ob_start();
    ?>

    <div id="<?=$this->hashCode()?>">
      <h1 id="title"><?=$this->LAYOUT->title?> ~ Dashboard Controller I</h1>
      <h3>::: <?=$this->ROUTE_DATA->params['verb']??"N/a"?></h3>
      <a href="/"><button>home...</button></a>
    </div>
    
    <?php

    return \ob_get_clean();
  }

}