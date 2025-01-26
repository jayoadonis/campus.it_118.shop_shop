<?php
declare(strict_types=1);

namespace campus\it_118\shop_shop\models;

class ObjectI {

  public function __toString(): string {

    return strtr(
      "<cN>@<hC>",
      [
        "<cN>" => \get_class($this),
        "<hC>" => \sprintf("%08x", $this->hashCode())
      ]
    );
  }

  public function hashCode(): int {

    return crc32(
      \spl_object_hash($this)
    );
  }
  
  //REM: [TODO] .|. TRUE => Cmp on itself only?
  public function equals(ObjectI $obj): bool {

    return $obj === $this;
  }


}