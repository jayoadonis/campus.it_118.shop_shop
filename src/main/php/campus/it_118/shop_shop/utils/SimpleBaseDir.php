<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\utils;

use Error;

class SimpleBaseDir {
  private string $basePath;

  public function __construct(string $basePath) {

      $realBasePath = realpath($basePath);

      if ($realBasePath === false || !is_dir($realBasePath))
          throw new \RuntimeException("Invalid base directory.");

      $this->basePath = $realBasePath;
  }

  private function validateFullPathWith(string $path = ''): string {

    $fullPath = realpath($this->basePath . DIRECTORY_SEPARATOR . $path);

    if ($fullPath === false || strpos($fullPath, $this->basePath) !== 0)
        throw new \RuntimeException("Access denied: Invalid path.");

    return $fullPath;
  }

  public function baseDirWith(string $path = ''): string {

      return "/" . substr(
        $this->validateFullPathWith($path), 
        strlen($this->basePath) + 1
      );
  }

  public function listFiles(string $subdir = ''): array {

      $dir = $this->validateFullPathWith($subdir);

      return array_diff(scandir($dir), ['.', '..']);
  }
}

//REM: Testing...
// try {
//   $sBDir = new SimpleBaseDir(__DIR__ . '/');
//   assert( $sBDir->baseDirWith("/") === "/");
  
//   // foreach( $sBDir->listFiles('/src/main/php/campus/it_118/shop_shop') as $x ) {
//   //   echo $x . "</br>";
//   // } 

// } catch (\RuntimeException $e) {
//   trigger_error( "Error: " . $e->getMessage(), E_USER_WARNING );
// }