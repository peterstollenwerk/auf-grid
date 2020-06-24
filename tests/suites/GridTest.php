<?php
use PHPUnit\Framework\TestCase;

final class PluginTest extends TestCase {
  public function testGridSettingsColumnCount () {
    $this->assertIsInt(option('auf.grid.settings.columnCount'));
  }
}