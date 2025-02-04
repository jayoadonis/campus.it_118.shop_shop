<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\views;

use campus\it_118\shop_shop\controllers\Controller;
use campus\it_118\shop_shop\models\View;

class HomeView extends View {

  public function __construct( Controller $controller) {

    parent::__construct($controller);
  }

  /**
   * @inheritDoc campus\it_118\shop_shop\models\IRenderer::render()
   * 
   */
  #[\Override]
  public function render(): string {
    
    $routeData = $this->controller->ROUTE_DATA;

    ob_start();
    ?>

    <div id="<?=$this->hashCode()?>">
      <h1>HomeView... II</h1>
      <h1><?=$routeData?></h1>
      <h1><?=$this->controller->LAYOUT->title?></h1>
      <a href="/dashboard">click it!</a>
      <a href="/dashboard/1024">click now!</a>
    </div>

    <?php
    return ob_get_clean();
  }
}