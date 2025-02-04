<?php

declare(strict_types=1);

require_once __DIR__ . "/src/main/php/campus/it_118/shop_shop/prefetch.php";

use campus\it_118\shop_shop\controllers\DashboardController;
use campus\it_118\shop_shop\controllers\DashboardControllerI;
use campus\it_118\shop_shop\controllers\HomeController;
use campus\it_118\shop_shop\controllers\HomeControllerI;
use campus\it_118\shop_shop\controllers\routes\RouterVI;
use campus\it_118\shop_shop\models\StarterUser;
use campus\it_118\shop_shop\utils\AccountStatus;
use campus\it_118\shop_shop\utils\routes\RouterDuplicationException;
use campus\it_118\shop_shop\views\layouts\SimpleLayout;

// include __VIEWS_DIR . "/dashboard_view.php";

$routerVI = new RouterVI( new SimpleLayout( __PROJECT_NAME ) );

try {
  $routerVI->get("/", [HomeControllerI::class]);
  $routerVI->get("/dashboard", [DashboardControllerI::class]);
  $routerVI->get("/dashboard/{verb}", [DashboardControllerI::class]);
  $routerVI->get("/dashboard/{id}/{verb}", [DashboardControllerI::class]);
  $routerVI->post("/dashboard/{id}/{verb}", [DashboardControllerI::class]);
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