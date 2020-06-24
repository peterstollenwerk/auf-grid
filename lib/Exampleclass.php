<?php

namespace auf;

use Kirby\Cms\StructureObject;

class Exampleclass extends StructureObject {
  
  public function __construct(string $value) {
    
    $this->value = $value;

  }

}
