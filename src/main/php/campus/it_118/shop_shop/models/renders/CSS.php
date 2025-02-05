<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models\renders;

class CSS {

  public function __construct(
    public readonly string|\SplFileObject|null $CSS_SRC
  ) {

  }

  public function flush(bool $asPath = false): string|false|null {

    if( $this->CSS_SRC === null ) return null;
    
    if( is_file($fileName = $this->CSS_SRC) && is_readable($fileName) ) {
      
      if( strtolower(pathinfo( $fileName, PATHINFO_EXTENSION)) !== "css")
        return null;

      if( $asPath ) return $this->CSS_SRC;

      ob_start(); 
      
      echo htmlspecialchars(file_get_contents($fileName));

      return ob_get_clean();
    }
    elseif ( $this->CSS_SRC instanceof \SplFileObject ) {
      
      if( strtolower(
            pathinfo( 
              $fileName = $this->CSS_SRC->getFilename(),
              PATHINFO_EXTENSION
            )
          ) !== "css"
      ) return null;

      return htmlspecialchars(file_get_contents($fileName));
    }

    return htmlspecialchars($this->CSS_SRC);
  }
}