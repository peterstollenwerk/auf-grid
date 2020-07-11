<?php

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\Grid;

final class GridTest extends TestCase {

  public function testConstructsGridPreset() {
    $grid = new Grid();
    $this->assertEquals($grid->gridPreset()->uid, 'grid--default');
  }

  public function testConstructsGridColumnDefaultPreset() {
    $grid = new Grid();
    $this->assertEquals(get_parent_class($grid->getGridColumnDefaultPreset()), 'Kirby\Cms\StructureObject');
    $this->assertEquals($grid->getGridColumnDefaultPreset(), 'grid__column--default');
  }
  
  public function testConstructsGridColumnSitePresets() {
    $grid = new Grid(site()->grid_column_presets()->toStructure());
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
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--start-1'), 'col');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--start-margin-left'), 'margin-left');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--start-margin-right'), 'margin-right');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--start-auto'), 'auto');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--end-1'), 'col');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--end-margin-left'), 'margin-left');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--end-margin-right'), 'margin-right');
    $this->assertEquals(Grid::getGridColumnStartEndType('grid__column--end-auto'), 'auto');
    $this->assertEquals(Grid::getGridColumnStartEndType('gruetze'), 'auto');
    $this->assertEquals(Grid::getGridColumnStartEndType('----------'), 'auto');
    $this->assertEquals(Grid::getGridColumnStartEndType(), 'auto');

  }

  public function testGetGridColumnSpan() {
    $grid = new Grid();
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-12'), option('auf.grid.settings.columnCount'));
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-3', 3), 3);
    
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-auto', 'grid__column--end-auto', 12), 12);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-auto', 'grid__column--span-3', 3), 3);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-auto', 'grid__column--end-6', 12), 6);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-auto', 'grid__column--end-margin-left', 12), 1);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-auto', 'grid__column--end-margin-right', 12), 13);
    
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-auto', 12), 12);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--span-3', 12), 3);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-6', 12), 6);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-margin-left', 12), 1);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-margin-right', 12), 13);
    
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-left', 'grid__column--end-auto', 12), 1);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-left', 'grid__column--span-3', 12), 3);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-left', 'grid__column--end-6', 12), 7);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-left', 'grid__column--end-margin-left', 12), 1);
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-left', 'grid__column--end-margin-right', 12), 14);
    
    $this->assertEquals($grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-margin-right', 'grid__column--end-margin-right', 12), 1);
  }

  public function testGetGridColumnSitePresets() {
    $presets = site()->grid_column_presets()->toStructure();
    $this->assertEquals($presets->first()->grid_column_class(), 'grid__column--full');
    $asidePreset = $presets->findBy('grid_column_class', 'grid__column--aside');
    $this->assertEquals($asidePreset->grid_column_class(), 'grid__column--aside');
    
    $grid = new Grid();
    $columnSpan = $grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-3');
    $this->assertEquals($columnSpan, 3);
    $spanWidthInPx = $grid->getGridColumnSpanWidthInPx(3);
    $this->assertEquals($spanWidthInPx, 302);
    $columnSpan = $grid->getGridColumnSpanByPreset('grid__column--aside');
    $this->assertEquals($columnSpan, 12);
    
    $grid = new Grid($presets);
    $columnSpan = $grid->getGridColumnSpanByPreset('grid__column--aside');
    $this->assertEquals($columnSpan, 5);

  }

  public function testShouldReturnDefaultColumnSpanIfPresetIsNotExistent() {
    $presets = site()->grid_column_presets()->toStructure();
    $grid = new Grid($presets);
    $columnSpan = $grid->getGridColumnSpanByPreset('grid__column--DOES_NOT_EXIST');
    $this->assertEquals($columnSpan, 12);
  }

}