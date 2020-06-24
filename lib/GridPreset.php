<?php

namespace auf;

use Kirby\Cms\StructureObject;

class GridPreset extends StructureObject {

  private $columnCount;
  private $maxColumnWidthInPx;
  private $columnGapInPx;
  
  public function __construct(
    string $uid = 'default',
    array $options = []
  ) {
    
    $fallbackOptions = [
      'columnCount'                         => 12,
      'maxColumnWidthInPx'                  => 90, 
      'columnGapInPx'                       => 16,
      'oneColumnToResponsiveBreakpointInPx' => 600
    ];
    
    $defaultOptions = [
      'columnCount'                         => option('auf.grid.settings.columnCount'),
      'maxColumnWidthInPx'                  => option('auf.grid.settings.maxColumnWidthInPx'), 
      'columnGapInPx'                       => option('auf.grid.settings.columnGapInPx'),
      'oneColumnToResponsiveBreakpointInPx' => option('auf.grid.settings.oneColumnToResponsiveBreakpointInPx')
    ];

    $options = (object)array_merge($fallbackOptions, $defaultOptions, $options);

    $this->id = $uid;

    $this->content = [
      'uid' => $uid,
      'columnCount' => $options->columnCount,
      'maxColumnWidthInPx' => $options->maxColumnWidthInPx,
      'columnGapInPx' => $options->columnGapInPx,
      'oneColumnToResponsiveBreakpointInPx' => $options->oneColumnToResponsiveBreakpointInPx,
      'columnGapsCount' => $columnGapsCount = $options->columnCount - 1,
      'responsiveToStaticBreakpointInPx' => $options->columnCount * $options->maxColumnWidthInPx + $columnGapsCount * $options->columnGapInPx
    ];
    
  }

}
