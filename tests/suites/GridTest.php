<?php

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\Grid;

final class GridTest extends TestCase {

  public function testConstructsGridPreset() {
    $grid = new Grid();
    $this->assertEquals($grid->gridPreset()->uid, 'default');
  }

  public function testConstructsGridColumnDefaultPreset() {
    $grid = new Grid();
    $this->assertEquals(get_parent_class($grid->getGridColumnDefaultPreset()), 'Kirby\Cms\StructureObject');
    $this->assertEquals($grid->getGridColumnDefaultPreset(), 'grid__column--default');
  }
  
  public function testConstructsGridColumnSitePresets() {
    $grid = new Grid(site()->grid_column_presets());
    $this->assertEquals(get_class($grid->getGridColumnSitePresets()), 'Kirby\Cms\Structure');
  }

  public function testReturnsColumnSpanWidthInPx() {
    $grid = new Grid();
    $span = 3;
    $expected = 
      option('auf.grid.settings.maxColumnWidthInPx') * $span + 
      option('auf.grid.settings.columnGapInPx') * ($span - 1)
    ;
    $this->assertEquals($grid->getGridColumnSpanWidthInPx(3), $expected);
  }

  public function testColumnTypeDetection() {
    $grid = new Grid();
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--start-1'), 'col');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--start-margin-left'), 'margin-left');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--start-margin-right'), 'margin-right');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--start-auto'), 'auto');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--end-1'), 'col');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--end-margin-left'), 'margin-left');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--end-margin-right'), 'margin-right');
    $this->assertEquals($grid->getGridColumnStartEndType('grid__column--end-auto'), 'auto');
    $this->assertEquals($grid->getGridColumnStartEndType('gruetze'), 'auto');
    $this->assertEquals($grid->getGridColumnStartEndType('----------'), 'auto');

  }

}