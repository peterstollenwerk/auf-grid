<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridColumnPreset extends StructureObject {
  
  public function __construct(string $uid, string $gridColumnStart, string $gridColumnEnd, string $label) {
    
    $this->id = $uid;

    $this->content = [
      'uid' => $uid,
      'grid_column_start' => $gridColumnStart,
      'grid_column_end' => $gridColumnEnd,
      'label' => $label
    ];
    
  }

}
