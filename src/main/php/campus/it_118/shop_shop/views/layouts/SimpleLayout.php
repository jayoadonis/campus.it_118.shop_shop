<?php

declare(strict_types=1);

namespace campus\it_118\shop_shop\views\layouts;

use campus\it_118\shop_shop\models\Layout;
use campus\it_118\shop_shop\models\renders\CSS;

class SimpleLayout extends Layout
{

  //REM: property CSS for render...

  public function __construct(
    string $title = null,
    string $outlet = null
  ) {
    parent::__construct(title: $title, outlet: $outlet);
  }

  /**
   * @return string
   */
  #[\Override]
  public function render( ?CSS $css = null ): string
  {

    $id = sprintf('%08x', $this->hashCode());

    ob_start();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $this->title ?></title>
      <link rel="stylesheet" href="<?=__SHOP_SHOP_MAIN_REZ_DIR."/css/global.css"?>">
      <link rel="stylesheet" href="<?=$css??$this->srcCSS?->flush(true)??''?>">

    </head>

    <body>
      <?php require_once(__VIEWS_DIR . "/components/header_component.php") ?>
      <div id="<?= $id ?>">
        <h1>SimpleLayout</h1>
        <?= $this->outlet ?>
      </div>
      <?php require_once(__VIEWS_DIR . "/components/footer_component.php") ?>
    </body>

    </html>

<?php
    return ob_get_clean();
  }
}
