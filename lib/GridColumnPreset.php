<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridColumnPreset extends StructureObject {
  
  public $gridColumnClass;
  public $gridColumnStartClass;
  public $gridColumnEndClass;
  public $gridColumnLabel;

  public function __construct(
    string $gridColumnClass, 
    string $gridColumnStartClass, 
    string $gridColumnEndClass, 
    string $gridColumnLabel) {

    $this->gridColumnClass = $gridColumnClass;
    $this->gridColumnStartClass = $gridColumnStartClass;
    $this->gridColumnEndClass = $gridColumnEndClass;
    $this->gridColumnLabel = $gridColumnLabel;
    
    $this->id = $gridColumnClass;

    $this->content = [
      'grid_column_class' => $gridColumnClass,
      'grid_column_start_class' => $gridColumnStartClass,
      'grid_column_end_class' => $gridColumnEndClass,
      'grid_column_label' => $gridColumnLabel
    ];
    
  }

}
