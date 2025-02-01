<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\views\layouts;

use campus\it_118\shop_shop\models\Layout;

class SimpleLayout extends Layout {

  public function __construct(
    string $outlet = null
  ) {
    parent::__construct($outlet);
  }

  /**
   * @return string
   */
  #[\Override]
  public function render(): string {

    $id = sprintf('%08x', $this->hashCode());

    return <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{__PROJECT_NAME}</title>
    </head>
    <body>
      <div id="{$id}">
        <h1>SimpleLayout</h1>
        {$this->outlet}
      </div>
    </body>
    </html>
    HTML;
  }



} 
