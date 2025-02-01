<?php
declare(strict_types=1);

$id = $routeData->params["id"]?? "N/a";
$verb = $routeData->params["verb"]?? "N/a";
\ob_start();
?>


<div id="home-view">
  <h1>Home View...</h1>
  <h3><?=$id?></h3>
  <h3><?=$verb?></h3>
</div>


<?php
$_content = \ob_get_clean();

include __VIEWS_DIR . "/layouts/simple_layout.php";
?>