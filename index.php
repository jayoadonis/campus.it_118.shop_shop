<?php

declare(strict_types=1);

require_once __DIR__ . "/src/main/php/campus/it_118/shop_shop/prefetch.php";

use campus\it_118\shop_shop\controllers\DashboardController;
use campus\it_118\shop_shop\controllers\HomeController;
use campus\it_118\shop_shop\controllers\routes\RouterVI;
use campus\it_118\shop_shop\utils\routes\RouterDuplicationException;

// include __VIEWS_DIR . "/dashboard_view.php";


$routerVI = new RouterVI();

try {
  $routerVI->get("/", [HomeController::class, "index"]);
  $routerVI->get("/{id}", [HomeController::class, "index"]);
  $routerVI->get("/dashboard", [DashboardController::class, "index"]);
  $routerVI->get("/dashboard/{id}", [DashboardController::class, "index"]);
  $routerVI->get("/dashboard/{id}/{verb}", [DashboardController::class, "index"]);
}
catch( RouterDuplicationException $rDE ) {

  $message = htmlspecialchars($rDE->getMessage());

  echo <<<HTML
  <script>
    console.error("[500]", "$message");
  </script>
  HTML;
}


// $METHOD = $_SERVER["REQUEST_METHOD"];
// $REQUEST_URI = $routerVI->getCurrentURI();

// $routerVI->dispatch( $METHOD, $REQUEST_URI );

$routerVI->dispatch();

echo "done";