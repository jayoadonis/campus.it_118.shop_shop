<?php

namespace campus\it_118\shop_shop\controllers;

use Context;

class HomeController {

  public function index(): void {

    include __VIEWS_DIR . "/home_view.php";
  }

  public function clean(): void {

    Context::remove("params");
  }
}