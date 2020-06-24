<?php
use PHPUnit\Framework\TestCase;

final class PluginTest extends TestCase {
  public function testTitleValue () {
    $this->assertEquals(site()->title()->value(), 'Auf-Grid');
  }
  public function testGridColumn () {
    $this->assertEquals(site()->find('home')->grid_column()->exists(), true);
  }
}