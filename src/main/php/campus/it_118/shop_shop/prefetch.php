<?php

declare(strict_types=1);


namespace campus\it_118\shop_shop;

define( "__PROJECT_NAME", "Shop Shop 0.0.0" );
define( 
  "__PROJECT_DIR", 
  realpath( __DIR__ . "/../../../../../.." ) 
);
define( 
  "__PUBLIC_DIR", 
  realpath( __PROJECT_DIR . "/public" ) 
);
define( 
  "__MAIN_SOURCE_DIR", 
  realpath( __PROJECT_DIR . "/src/main" ) 
);
define(
  "__MAIN_RESOURCES_DIR", 
  realpath( __PROJECT_DIR . "/src/main/resources" )
);

define(
  "__VIEWS_DIR",
  realpath( __PROJECT_DIR . "/src/main/php/campus/it_118/shop_shop/views" )
);

define(
  "__DATE_TIME_ZONE",
  (new \DateTimeZone("Asia/Manila"))
);

require_once __PROJECT_DIR . "/vendor/autoload.php";


$_content = "<h1>Content not found</h1>";
