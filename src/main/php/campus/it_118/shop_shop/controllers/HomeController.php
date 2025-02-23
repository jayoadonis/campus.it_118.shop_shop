<?php

namespace campus\it_118\shop_shop\controllers;

use campus\it_118\shop_shop\controllers\routes\RouteData;
use campus\it_118\shop_shop\utils\Context;

class HomeController {

  public function index( RouteData $routeData ): void {

    include __VIEWS_DIR . "/home_view.php";
  }

  public function clean(): void {

    Context::remove("params");
  }
}