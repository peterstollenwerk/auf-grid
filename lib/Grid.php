<?php 

namespace auf;

use auf\GridPreset;
use auf\GridColumnPreset;
use Kirby\Cms\Field;
use Kirby\Data\Json;
use Kirby\Data\Yaml;

class Grid {

  
  static $gridColumnCustomClass = 'grid__column--custom';
  
  private $gridPreset;
  private $gridColumnDefaultPreset;
  private $gridColumnSitePresets;

  public function __construct(Field $grid_column_presets = NULL) {

    $this->gridPreset = new GridPreset();

    $this->setGridColumnDefaultPreset();

    if($grid_column_presets) { $this->setGridColumnSitePresets($grid_column_presets); }

  }

  public function gridPreset() { 
    return $this->gridPreset; 
  }

  public function setGridColumnDefaultPreset() {
    return $this->gridColumnDefaultPreset = new GridColumnPreset( 
      $gridColumnDefaultClass = 'grid__column--default',
      $gridColumnDefaultStartColumnClass = 'grid__column--start-1',
      $gridColumnDefaultEndColumnClass = 'grid__column--end-12',
      $gridColumnDefaultLabel = 'Default'
    );
  }

  public function getGridColumnDefaultPreset() {
    return $this->gridColumnDefaultPreset;
  }

  public function setGridColumnSitePresets(Field $grid_column_presets) {
    if($grid_column_presets->isNotEmpty()) {
      $this->gridColumnSitePresets  = $grid_column_presets->toStructure();
    }
  }

  public function getGridColumnSitePresets() {
    return $this->gridColumnSitePresets;
  }

  public function getGridColumnPreset(string $presetUid) {
    $preset = $this->getGridColumnSitePresets()->findBy('uid', $presetUid);
    return $preset ? $preset : $this->getGridColumnDefaultPreset();
  }

  public function getGridColumnSpanWidthInPx($columnSpan) {
    return (
      $columnSpan * $this->gridPreset()->maxColumnWidthInPx() + 
      ($columnSpan - 1) * $this->gridPreset()->columnGapInPx()
    );
  }

  static function getGridColumnStartEndType($gridColumnStartEndValue) {
    if     (strpos($gridColumnStartEndValue, 'grid__column--start-margin-left') !== false) { return 'margin-left'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-margin-left') !== false) { return 'margin-left'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start-margin-right') !== false) { return 'margin-right'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-margin-right') !== false) { return 'margin-right'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start-auto') !== false) { return 'auto'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start') !== false) { return 'col'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-auto') !== false) { return 'auto'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end') !== false) { return 'col'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--span') !== false) { return 'span'; } 
    else {
      return 'auto';
    }
  }

  static function getGridColumnNumber($gridColumnStartEndValue) : int {
    if (strpos($gridColumnStartEndValue, 'start') !== false) { 
      return Grid::getGridColumnStartNumber($gridColumnStartEndValue); 
    }
    if (strpos($gridColumnStartEndValue, 'end') !== false) { 
      return Grid::getGridColumnEndNumber($gridColumnStartEndValue); 
    }
    else {
      return $fallback = 1;
    }
  }
  // TODO: Make Variables from the grid__column--start/end'-hardcoded-values!
  static function getGridColumnStartNumber($gridColumnStartValue) {
    return (int) str_replace('grid__column--start-', '', $gridColumnStartValue);
  }

  static function getGridColumnEndNumber($gridColumnEndValue) {
    return (int) str_replace('grid__column--end-', '', $gridColumnEndValue);
  }

  static function getGridColumnSpanNumber($gridColumnStartEndValue) {
    return (int) str_replace('grid__column--span-', '', $gridColumnStartEndValue);
  }

  public function getGridColumnSpan(
    string $gridColumnStart = 'grid__column--start-1', 
    string $gridColumnEnd   = 'grid__column--end-12',
    $gridTotalColumns = NULL
    ) {

    if($gridTotalColumns === NULL) {
      $gridTotalColumns = Grid::$gridColumnsCount;
    }

    $startType = Grid::getGridColumnStartEndType($gridColumnStart);
    $endType   = Grid::getGridColumnStartEndType($gridColumnEnd);
    
  
    // NEXT: Create ALL POSSIBLE span values and 
    // Test with real data!
  
    if($startType === 'auto' && $endType === 'auto') {
      return Grid::getGridColumnNumber(Grid::$gridColumnDefaultEndColumnClass) - Grid::getGridColumnNumber(Grid::$gridColumnDefaultStartColumnClass);
    }
    if($startType === 'auto' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    
    if($startType === 'auto' && $endType === 'col') {
      return Grid::getGridColumnNumber($gridColumnEnd);
    }

    // MISSING auto / margin-left-start
    // MISSING auto / margin-right-end

    # grid-column: col-2 / col-6 => 6 - 2 => 4
    if($startType === 'col' && $endType === 'col') {
      return Grid::getGridColumnNumber($gridColumnEnd) - Grid::getGridColumnNumber($gridColumnStart) + 1;
    }
    # col-4 / span-3 => 3
    if($startType === 'col' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    
    # col-6 / margin-right => 12 - (6 - 1)  + 1 => 8 /// 14 - 5 - 1 => 8
    if($startType === 'col' && $endType === 'margin-right') {
      return $gridTotalColumns - (Grid::getGridColumnNumber($gridColumnStart) - 1) + 1;
    }

    if($startType === 'col' && $endType === 'auto') {
      return (Grid::getGridColumnNumber(Grid::$gridColumnDefaultEndColumnClass) 
        - Grid::getGridColumnNumber($gridColumnStart) - 1);
    }


    # margin-left / span-4 => 4
    if($startType === 'margin-left' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    # margin-left / col-3 =>  1 + 3 => 4
    if($startType === 'margin-left' && $endType === 'col') {
      return 1 + Grid::getGridColumnNumber($gridColumnEnd);
    }
    # margin-left / margin-right => 1 + 12 + 1
    if($startType === 'margin-left' && $endType === 'margin-right') {
      return 1 + $gridTotalColumns + 1;
    }
    # margin-left / margin-left => 1
    if($startType === 'margin-left' && $endType === 'margin-left') {
      return 1;
    }
    # margin-left / margin-left => 1
    if($startType === 'margin-right' && $endType === 'margin-right') {
      return 1;
    }
  }


  public function getGridColumnSpanByPreset(string $presetUid) {
    $preset = $this->getGridColumnPreset($presetUid);
    return $this->getGridColumnSpan($preset->grid_column_start(), $preset->grid_column_end());
  }


  // --------------------------------------

  static function getSettings() {
    $file = kirby()->root('config') . '/auf-grid/settings.yml';
    if(file_exists($file)) {
      return Yaml::read($file);
    }
    return Json::decode('{"info": "No configuration yet"}');
  }

  static function setSettings($settings) {
    $file = kirby()->root('config') . '/auf-grid/settings.yml';
    Yaml::write($file, $settings);
    return $settings;
  }

}