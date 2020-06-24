<?php 

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\GridColumnPreset;

final class GridColumnPresetTest extends TestCase {
  public function getPreset() 
  {
    return $this->preset = new GridColumnPreset(
      $uid = 'test', 
      $gridColumnStart = 'grid__column--start-1', 
      $gridColumnEnd = 'grid__column--end-12', 
      $label = 'GridColumnTestPreset'
    );
  }
  public function testGridColumnPresetParentClassIsKirbyStructureObject () 
  {
    $this->assertEquals(get_parent_class($this->getPreset()), 'Kirby\Cms\StructureObject');
  }
  public function testGridColumnPresetUidIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->uid()->value(), 'test'); 
  }
  public function testGridColumnPresetGridColumnStartIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_start()->value(), 'grid__column--start-1'); 
  }
  public function testGridColumnPresetGridColumnEndIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->grid_column_end()->value(), 'grid__column--end-12'); 
  }
  public function testGridColumnPresetGridColumnLabelIsCorrect () 
  { 
    $this->assertEquals($this->getPreset()->label()->value(), 'GridColumnTestPreset'); 
  }
}