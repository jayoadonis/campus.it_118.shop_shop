<?php
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=__PROJECT_NAME?></title>
</head>
<body>
  <?php include __VIEWS_DIR . "/components/header_component.php"?>
  <?=$_content?>
  <?php include __VIEWS_DIR . "/components/footer_component.php"?>
</body>
</html>