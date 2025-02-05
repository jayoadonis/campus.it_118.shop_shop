<?php

declare(strict_types=1);

require_once __DIR__ . "/src/main/php/campus/it_118/shop_shop/prefetch.php";

use campus\it_118\shop_shop\controllers\DashboardControllerI;
use campus\it_118\shop_shop\controllers\HomeControllerI;
use campus\it_118\shop_shop\controllers\routes\RouterVI;
use campus\it_118\shop_shop\utils\routes\RouterDuplicationException;
use campus\it_118\shop_shop\views\layouts\SimpleLayout;


$routerVI = new RouterVI(new SimpleLayout(__PROJECT_NAME));

try {

  $routerVI->get("/", [HomeControllerI::class]);
  $routerVI->get("/dashboard", [DashboardControllerI::class]);
  $routerVI->get("/dashboard/{verb}", [DashboardControllerI::class]);
  $routerVI->get("/dashboard/{id}/{verb}", [DashboardControllerI::class]);
  $routerVI->post("/dashboard/{id}/{verb}", [DashboardControllerI::class]);
  $routerVI->setPageNotFound(function () {
    ob_start();
    ?>
  
    <div id="page-not-found">
      <h1>404: Page Not Found</h1>
    </div>
  
    <?php

    return ob_get_clean();
  });
} catch (RouterDuplicationException $rDE) {

  $message = htmlspecialchars($rDE->getMessage());

  echo <<<HTML
  <script>
    console.error("[500]", "{$message}");
  </script>
  HTML;
} catch (\Exception $ex) {

  echo <<<HTML
  <script>
    console.error("[500]", "Something went wrong... {$ex->getMessage()}");
  </script>
  HTML;
}


try {

  $routerVI->dispatch();
} catch (\Exception $ex) {
  //REM: Ignore....
}

// foreach ($routerVI->getRoutes() as $method => $paths) {
//   echo "<pre>";
//     echo $method . " => </br>";
//   foreach( $paths as $key => $value ) {
//     echo $key . " => " . $value . "</br>";
//   }
//   echo "</pre>";
// }
