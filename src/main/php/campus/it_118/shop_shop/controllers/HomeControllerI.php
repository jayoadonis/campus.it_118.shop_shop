<?php

namespace campus\it_118\shop_shop\controllers;

use campus\it_118\shop_shop\controllers\routes\RouteData;
use campus\it_118\shop_shop\utils\Context;
use campus\it_118\shop_shop\controllers\Controller;
use campus\it_118\shop_shop\models\Layout;
use campus\it_118\shop_shop\models\renders\CSS;
use campus\it_118\shop_shop\views\HomeView;

class HomeControllerI extends Controller {

  public function __construct(
    ?Layout $layout = null,
    RouteData $routeData
  ) {
    parent::__construct($layout, $routeData);

  }

  public function render(?CSS $css = null): string {

    // $verb = $this->ROUTE_DATA->params["verb"]??"N/a";

    // return <<<HTML
    // <div id="">
    //   <h1>Home View I</h1>
    //   <h1>{$verb}</h1>
    // </div>
    // HTML;

    ob_start();
    ?>

    <div id="<?=$this->hashCode()?>">
      <?php
        echo (new HomeView($this))->render(
          $css ??
          new CSS( __SHOP_SHOP_MAIN_REZ_DIR . "/css/home_view.css")
        );
      ?>
    </div>

    <?php
    return ob_get_clean();
  }

  public function clean(): void {

    Context::remove("params");
  }
}