<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridPreset extends StructureObject {

  public $id;
  public $columnCount;
  public $maxColumnWidthInPx;
  public $columnGapInPx;
  public $oneColumnToResponsiveBreakpointInPx;
  public $columnGapsCount;
  public $responsiveToStaticBreakpointInPx;
  public $rowGap;


  public function __construct() {
    
    $fallbackSettings = [
      'id' => 'grid--default',
      'columnCount'                         => 12,
      'maxColumnWidthInPx'                  => 90, 
      'oneColumnToResponsiveBreakpointInPx' => 600,
      'columnGapInPx'                       => 16,
      'rowGap'                              => '1rem'
    ];
    
    $configSettings = [
      'columnCount'                         => option('auf.grid.settings.columnCount'),
      'maxColumnWidthInPx'                  => option('auf.grid.settings.maxColumnWidthInPx'), 
      'oneColumnToResponsiveBreakpointInPx' => option('auf.grid.settings.oneColumnToResponsiveBreakpointInPx'),
      'columnGapInPx'                       => option('auf.grid.settings.columnGapInPx'),
      'rowGap'                              => option('auf.grid.settings.rowGap')
    ];

    $settings = (object)array_merge($fallbackSettings, $configSettings);

    $this->id = $settings->id;
    $this->columnCount = $settings->columnCount;
    $this->maxColumnWidthInPx = $settings->maxColumnWidthInPx;
    $this->columnGapInPx = $settings->columnGapInPx;
    $this->oneColumnToResponsiveBreakpointInPx = $settings->oneColumnToResponsiveBreakpointInPx;
    $this->rowGap = $settings->rowGap;
    $this->columnGapsCount = $columnGapsCount = $settings->columnCount - 1;
    $this->responsiveToStaticBreakpointInPx = $settings->columnCount * $settings->maxColumnWidthInPx + $columnGapsCount * $settings->columnGapInPx;
    
  }

}
