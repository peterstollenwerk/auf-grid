<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridColumnPreset extends StructureObject {
  
  public function __construct(
    string $gridColumnClass, 
    string $gridColumnStartClass, 
    string $gridColumnEndClass, 
    string $gridColumnLabel) {
    
    $this->id = $gridColumnClass;

    $this->content = [
      'grid_column_class' => $gridColumnClass,
      'grid_column_start_class' => $gridColumnStartClass,
      'grid_column_end_class' => $gridColumnEndClass,
      'grid_column_label' => $gridColumnLabel
    ];
    
  }

}
