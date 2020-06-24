<?php

declare(strict_types=1);

namespace auf;

use PHPUnit\Framework\TestCase;

use auf\Grid;

final class PluginTest extends TestCase {
  public function testGridSettingsColumnCount () 
  {
    $this->assertIsInt(option('auf.grid.settings.columnCount'));
  }
  public function testCreatesGridPreset() {
    $grid = new Grid();
    $this->assertEquals(get_parent_class($grid->preset()), 'Kirby\Cms\StructureObject');
    $this->assertEquals($grid->preset()->uid()->value(), 'default');
  }

}