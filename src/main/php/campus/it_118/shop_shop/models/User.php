<?php

declare(strict_types=1);


namespace campus\it_118\shop_shop\models;

use \DateTime;

abstract class User implements IEntity {

  public readonly string $id;
  public readonly string $username;
  public readonly DateTime $dateTime;

  public function __construct(
    string $id = null,
    string $username = null,
    DateTime $dateTime = null
  ) {
    $this->id = $id??"N/a";
    $this->username = $username??"N/a";
    $this->dateTime = $dateTime??new DateTime();
  }

  /**
   * @Override
   */
  public function getId(): string {

    return $this->id;
  }
  
  
}