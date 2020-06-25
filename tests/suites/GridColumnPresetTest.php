<?php 

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\GridColumnPreset;

final class GridColumnPresetTest extends TestCase {
  public function getPreset() 
  {
    return $this->preset = new GridColumnPreset(
      'grid__column--test', 
      'grid__column--start-1', 
      'grid__column--end-12', 
      'GridColumnTestPreset'
    );
  }
  public function testGridColumnPresetParentClassIsKirbyStructureObject () 
  {
    $this->assertEquals(get_parent_class($this->getPreset()), 'Kirby\Cms\StructureObject');
  }
  public function testGridColumnPresetUidIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_class()->value(), 'grid__column--test'); 
  }
  public function testGridColumnPresetGridColumnStartIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_start_class()->value(), 'grid__column--start-1'); 
  }
  public function testGridColumnPresetGridColumnEndIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_end_class()->value(), 'grid__column--end-12'); 
  }
  public function testGridColumnPresetGridColumnLabelIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_label()->value(), 'GridColumnTestPreset'); 
  }
}