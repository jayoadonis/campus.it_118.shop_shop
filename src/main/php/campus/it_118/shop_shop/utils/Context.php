<?php
declare(strict_types=1);

class Context {

  /**
   * @var array<string,mixed>
   */
  private static array $DATA = [];

  private function __construct() {
    //REM: Ignore.
  }

  public static function set(
    string $key,
    mixed $data
  ): void {
    self::$DATA[$key] = $data;
  }

  public static function get( string $key ): mixed {
    return self::$DATA[$key] ?? null;
  }

  public static function remove( string $key ): mixed {
    $prevData = self::$DATA[$key];

    unset(self::$DATA[$key]);

    return $prevData;
  }

  public static function clear(): void {
    self::$DATA = [];
  }

  /**
   * 
   * @return array<string,mixed>
   */
  public static function getAll(): array {

    return self::$DATA;
  }
}