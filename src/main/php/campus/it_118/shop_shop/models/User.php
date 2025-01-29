<?php

declare(strict_types=1);


namespace campus\it_118\shop_shop\models;

use campus\it_118\shop_shop\utils\Status;

use \DateTime;
use \DateTimeZone;

abstract class User extends ObjectI implements IEntity
{

  private readonly string $ID;
  protected string $username;
  protected readonly DateTime $LOGGED_IN_DATE_TIME;
  protected readonly DateTime $REGISTERED_DATE_TIME;

  public function __construct(
    ?string $id = null,
    ?string $username = null,
    DateTime|string|null $REGISTERED_DATE_TIME = null,
    DateTime|string|null $LOGGED_IN_DATE_TIME = null
  ) {
    $this->ID = !empty($id = trim($id??'')) 
      ? $id : Status::unknown()->SYMBOL;

    $this->username = !empty($username = trim($username??''))
      ? $username : Status::unknown()->SYMBOL ;

    try {
      $this->REGISTERED_DATE_TIME = match (true) {
        is_string($REGISTERED_DATE_TIME)
        => new DateTime(
          $REGISTERED_DATE_TIME ?: "now",
          __DATE_TIME_ZONE
        ),

        ($REGISTERED_DATE_TIME instanceof DateTime)
        => $REGISTERED_DATE_TIME,

        default => throw new \Exception()
      };
    } catch (\Exception $e) {
      $this->REGISTERED_DATE_TIME = new DateTime(
        "now", __DATE_TIME_ZONE
      );
    }

    try{
      $this->LOGGED_IN_DATE_TIME = match (true) {
        is_string($LOGGED_IN_DATE_TIME)
        => new DateTime(
          $LOGGED_IN_DATE_TIME ?: "now",
          __DATE_TIME_ZONE
        ),
        ($LOGGED_IN_DATE_TIME instanceof DateTime)
        => $LOGGED_IN_DATE_TIME,
        default => throw new \Exception()
      };
    }
    catch( \Exception $exception ) {
      $this->LOGGED_IN_DATE_TIME = new DateTime(
        "now", __DATE_TIME_ZONE 
      );
    }
  }

  /**
   * @Override
   */
  public function getId(): string
  {

    return $this->ID;
  }

  public function getLoggedInDateTime(): string
  {

    return $this->LOGGED_IN_DATE_TIME->format("D, d M Y h:i:s a P T");
  }

  /**
   * 
   * @Override
   * @return string
   */
  public function __toString(): string {


    return strtr(
      "<cN>@<hC>"
      ."[ID='<id>', REGISTERED_DATE_TIME='<registeredDateTime>', LOGGED_IN_DATE_TIME='<loggedInDateTime>']",
      [
        "<cN>" => \get_class($this),
        "<hC>" => \sprintf("%08x", $this->hashCode()),
        "<id>" => $this->ID,
        "<registeredDateTime>" => 
          $this->REGISTERED_DATE_TIME->getTimestamp(),
        "<loggedInDateTime>" => $this->getLoggedInDateTime()
      ]
    );
  }

  /**
   * @inheritDoc ObjectI::hashCode(V)I
   * @method hashCode(void):int
   * @return int
   */
  public function hashCode(): int {

    return \crc32( 
        $this->ID 
      . $this->username 
      . $this->REGISTERED_DATE_TIME->format("Y-m-d D") 
    );
  }

  /**
   * @Override
   * @param ObjectI $obj
   * @return bool
   * 
   * @see campus\it_118\shop_shop\models\ObjectI::equals()
   */
  public function equals( ObjectI $obj ): bool {
    if( $obj === $this ) return true;
    if( !($obj instanceof self) )
      return false;
    
    return $obj->ID === $this->ID 
      && $obj->username === $this->username
      && $obj->REGISTERED_DATE_TIME->getTimestamp() === $this->REGISTERED_DATE_TIME->getTimestamp();
  }

}
