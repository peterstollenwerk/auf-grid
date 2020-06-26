<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridPreset extends StructureObject {

  public $uid;
  public $columnCount;
  public $maxColumnWidthInPx;
  public $columnGapInPx;
  public $oneColumnToResponsiveBreakpointInPx;
  public $columnGapsCount;
  public $responsiveToStaticBreakpointInPx;


  public function __construct() {
    
    $fallbackSettings = [
      'uid' => 'grid--default',
      'columnCount'                         => 12,
      'maxColumnWidthInPx'                  => 90, 
      'columnGapInPx'                       => 16,
      'oneColumnToResponsiveBreakpointInPx' => 600
    ];
    
    $configSettings = [
      'columnCount'                         => option('auf.grid.settings.columnCount'),
      'maxColumnWidthInPx'                  => option('auf.grid.settings.maxColumnWidthInPx'), 
      'columnGapInPx'                       => option('auf.grid.settings.columnGapInPx'),
      'oneColumnToResponsiveBreakpointInPx' => option('auf.grid.settings.oneColumnToResponsiveBreakpointInPx')
    ];

    $settings = (object)array_merge($fallbackSettings, $configSettings);

    $this->uid = $settings->uid;
    $this->columnCount = $settings->columnCount;
    $this->maxColumnWidthInPx = $settings->maxColumnWidthInPx;
    $this->columnGapInPx = $settings->columnGapInPx;
    $this->oneColumnToResponsiveBreakpointInPx = $settings->oneColumnToResponsiveBreakpointInPx;
    $this->columnGapsCount = $columnGapsCount = $settings->columnCount - 1;
    $this->responsiveToStaticBreakpointInPx = $settings->columnCount * $settings->maxColumnWidthInPx + $columnGapsCount * $settings->columnGapInPx;
    
  }

}
