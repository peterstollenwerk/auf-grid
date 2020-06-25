<?php

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\GridPreset;

final class GridPresetTest extends TestCase {

  public function testGridPresetParentClassIsKirbyStructureObject () 
  {
    $this->assertEquals(get_parent_class(new GridPreset()), 'Kirby\Cms\StructureObject');
  }
  public function testConstructsDefaultGridWhenPassingNoArguments() 
  {
    $gridPreset = new GridPreset();
    $this->assertEquals($gridPreset->content()->columnCount()->value(), 12);
    $this->assertEquals($gridPreset->content()->maxColumnWidthInPx()->value(), 90);
    $this->assertEquals($gridPreset->content()->columnGapsCount()->value(), 11);
    $this->assertEquals($gridPreset->content()->columnGapInPx()->value(), 16);
    $this->assertEquals($gridPreset->content()->oneColumnToResponsiveBreakpointInPx()->value(), 600);
    $this->assertEquals($gridPreset->content()->responsiveToStaticBreakpointInPx()->value(), 1256);
  }
  public function testConstructsGridWithArguments() 
  {
    $gridPreset = new GridPreset(
      $uid = 'myPreset',
      $options = [
        'columnCount' => 10,
        'maxColumnWidthInPx' => 86,
        'columnGapInPx' => 12,
        'oneColumnToResponsiveBreakpointInPx' => 444
      ]
    );
    $this->assertEquals($gridPreset->content()->uid()->value(), 'myPreset');
    $this->assertEquals($gridPreset->content()->columnCount()->value(), 10);
    $this->assertEquals($gridPreset->content()->maxColumnWidthInPx()->value(), 86);
    $this->assertEquals($gridPreset->content()->columnGapInPx()->value(), 12);
    $this->assertEquals($gridPreset->content()->oneColumnToResponsiveBreakpointInPx()->value(), 444);
    $this->assertEquals($gridPreset->content()->columnGapsCount()->value(), 9);
    $this->assertEquals($gridPreset->content()->responsiveToStaticBreakpointInPx()->value(), 10 * 86 + 9 * 12);
  }
}