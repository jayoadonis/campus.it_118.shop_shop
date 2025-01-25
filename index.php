<?php

declare(strict_types=1);

require_once __DIR__ . "/src/main/php/campus/it_118/shop_shop/prefetch.php";

use campus\it_118\shop_shop\controllers\routes\RouteV0;

include __VIEWS_DIR . "/dashboard_view.php";

use campus\it_118\shop_shop\models\StarterUser;
use campus\it_118\shop_shop\utils\Status;

$s = new StarterUser();
// \usleep(1_000_000);
$a = new StarterUser();

echo $s->getLoggedInDateTime() . "</br>";

echo $s . "</br>";
echo $a . "</br>";

echo $a->equals($s) . "</br>";


echo Status::approved()->DESCRIPTION;

echo "done";