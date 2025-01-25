<?php
declare(strict_types=1);

\ob_start();
?>


<div id="home-view">
  <h1>Home View...</h1>
</div>


<?php
$_content = \ob_get_clean();

include __VIEWS_DIR . "/layouts/simple_layout.php";
?>