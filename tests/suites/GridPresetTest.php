<?php

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\GridPreset;

final class GridPresetTest extends TestCase {

  public function testConstructsDefaultGridWhenPassingNoArguments() 
  {
    $gridPreset = new GridPreset();
    $this->assertEquals($gridPreset->columnCount, 12);
    $this->assertEquals($gridPreset->maxColumnWidthInPx, 90);
    $this->assertEquals($gridPreset->columnGapsCount, 11);
    $this->assertEquals($gridPreset->columnGapInPx, 16);
    $this->assertEquals($gridPreset->oneColumnToResponsiveBreakpointInPx, 600);
    $this->assertEquals($gridPreset->responsiveToStaticBreakpointInPx, 1256);
  }
}