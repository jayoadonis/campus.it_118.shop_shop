<?php

declare(strict_types=1);

require_once __DIR__ . "/src/main/php/campus/it_118/shop_shop/prefetch.php";

use campus\it_118\shop_shop\controllers\DashboardController;
use campus\it_118\shop_shop\controllers\HomeController;
use campus\it_118\shop_shop\controllers\routes\RouterVI;

// include __VIEWS_DIR . "/dashboard_view.php";


$routerVI = new RouterVI();

$routerVI->add('GET', "/", [HomeController::class, "index"]);
$routerVI->add('GET', "/{id}", [HomeController::class, "index"]);
$routerVI->add('GET', "/dashboard", [DashboardController::class, "index"]);
$routerVI->add('GET', "/dashboard/{id}", [DashboardController::class, "index"]);
$routerVI->add('GET', "/dashboard/{id}/{verb}", [DashboardController::class, "index"]);


// $METHOD = $_SERVER["REQUEST_METHOD"];
// $REQUEST_URI = $routerVI->getCurrentURI();

// $routerVI->dispatch( $METHOD, $REQUEST_URI );

$routerVI->dispatch();
echo "done";