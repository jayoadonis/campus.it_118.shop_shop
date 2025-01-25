<?php

declare(strict_types=1);


namespace campus\it_118\shop_shop\models;

use \DateTime;
use \DateTimeZone;

abstract class User implements IEntity
{

  public readonly string $id;
  public string $username;
  public readonly DateTime $loggedInDateTime;
  public readonly DateTime $registeredDateTime;

  public function __construct(
    ?string $id = null,
    ?string $username = null,
    DateTime|string|null $registeredDateTime = null,
    DateTime|string|null $loggedInDateTime = null
  ) {
    $this->id = $id ?? "N/a";

    $this->username = $username ?? "N/a";

    try {
      $this->registeredDateTime = match (true) {
        is_string($registeredDateTime)
        => new DateTime(
          $registeredDateTime ?: "now",
          __DATE_TIME_ZONE
        ),

        ($registeredDateTime instanceof DateTime)
        => $registeredDateTime,

        default => throw new \Exception()
      };
    } catch (\Exception $e) {
      $this->registeredDateTime = new DateTime(
        "now", __DATE_TIME_ZONE
      );
    }

    try{
      $this->loggedInDateTime = match (true) {
        is_string($loggedInDateTime)
        => new DateTime(
          $loggedInDateTime ?: "now",
          __DATE_TIME_ZONE
        ),
        ($loggedInDateTime instanceof DateTime)
        => $loggedInDateTime,
        default => throw new \Exception()
      };
    }
    catch( \Exception $exception ) {
      $this->loggedInDateTime = new DateTime(
        "now", __DATE_TIME_ZONE 
      );
    }
  }

  /**
   * @Override
   */
  public function getId(): string
  {

    return $this->id;
  }

  public function loggedInDateTime(): string
  {

    return $this->loggedInDateTime->format("D, d M Y h:i:s a P T");
  }

  public function __toString(): string {

    return strtr(
      "<cannonicalName>@<hashCode>[id='<id>', registeredDateTime='<registeredDateTime>', loggedInDateTime='<loggedInDateTime>']",
      [
        "<cannonicalName>" => \get_class($this),
        "<hashCode>" => \dechex($this->hashCode()),
        "<id>" => $this->id,
        "<registeredDateTime>" => $this->registeredDateTime->getTimestamp(),
        "<loggedInDateTime>" => $this->loggedInDateTime()
      ]
    );
  }

  public function hashCode(): int {

    return \crc32( 
        $this->id 
      . $this->username 
      . $this->registeredDateTime->getTimestamp() 
    );
  }

  public function equals( object $obj ) {
    if( $obj === $this ) return true;
    if( !($obj instanceof self) )
      return false;
    
    return $obj->id === $this->id 
      && $obj->username === $this->username
      && $obj->registeredDateTime->getTimestamp() === $this->registeredDateTime->getTimestamp();
  }
}
