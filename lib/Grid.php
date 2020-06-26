<?php 

namespace auf;

use auf\GridPreset;
use auf\GridColumnPreset;
use Kirby\Cms\Structure;
use Kirby\Data\Json;
use Kirby\Data\Yaml;

class Grid {

  
  static $gridColumnCustomClass = 'grid__column--custom';
  
  private $gridPreset;
  private $gridColumnDefaultPreset;
  private $gridColumnSitePresets;

  public function __construct(Structure $grid_column_presets = NULL) {

    $this->gridPreset = new GridPreset();

    $this->setGridColumnDefaultPreset();

    if($grid_column_presets) {
      $this->gridColumnSitePresets  = $grid_column_presets;
    }

  }

  public function gridPreset() { 
    return $this->gridPreset; 
  }
  public function gridColumnDefaultPreset() { 
    return $this->gridColumnDefaultPreset; 
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

  public function getGridColumnSitePresets() {
    return $this->gridColumnSitePresets;
  }

  public function getGridColumnPreset(string $grid_column_class = '') {
    if($presets = $this->getGridColumnSitePresets()) {
      $preset = $presets->findBy('grid_column_class', $grid_column_class);
    } else {
      return $this->getGridColumnDefaultPreset();
    }
  }

  public function getGridColumnSpanByPreset(string $grid_column_class = '') {
    $preset = $this->getGridColumnPreset($grid_column_class);
    return $this->getGridColumnSpan($preset->grid_column_start_class(), $preset->grid_column_end_class());
  }

  public function getGridColumnSpanWidthInPx($columnSpan) {
    return (
      $columnSpan * $this->gridPreset()->maxColumnWidthInPx() + 
      ($columnSpan - 1) * $this->gridPreset()->columnGapInPx()
    );
  }

  static function getGridColumnStartEndType($gridColumnStartEndValue = NULL) {
    if     (strpos($gridColumnStartEndValue, 'grid__column--start-margin-left') !== false) { return 'margin-left'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-margin-left') !== false) { return 'margin-left'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start-margin-right') !== false) { return 'margin-right'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-margin-right') !== false) { return 'margin-right'; }
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start-auto') !== false) { return 'auto'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--end-auto') !== false) { return 'auto'; } 
    elseif (strpos($gridColumnStartEndValue, 'grid__column--start') !== false) { return 'col'; } 
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
      $gridTotalColumns = $this->gridPreset()->columnCount();
    }
    $startType = Grid::getGridColumnStartEndType($gridColumnStart);
    $endType   = Grid::getGridColumnStartEndType($gridColumnEnd);
    
    $gridColumnDefaultStartClass = $this->gridColumnDefaultPreset()->gridColumnStartClass();
    $gridColumnDefaultEndClass = $this->gridColumnDefaultPreset()->gridColumnEndClass();

    if($startType === 'auto' && $endType === 'auto') {
      return Grid::getGridColumnNumber($gridColumnDefaultEndClass) - Grid::getGridColumnNumber($gridColumnDefaultStartClass) + 1;
    }
    if($startType === 'auto' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    if($startType === 'auto' && $endType === 'col') {
      return Grid::getGridColumnNumber($gridColumnEnd);
    }
    if($startType === 'auto' && $endType === 'margin-left') {
      return 1;
    }
    if($startType === 'auto' && $endType === 'margin-right') {
      return 
        Grid::getGridColumnNumber($gridColumnDefaultEndClass) - 
        Grid::getGridColumnNumber($gridColumnDefaultStartClass) + 1 + 1;
    }


    if($startType === 'col' && $endType === 'auto') {
      return 
        Grid::getGridColumnNumber($gridColumnDefaultEndClass) - 
        Grid::getGridColumnNumber($gridColumnStart) + 1;
    }
    if($startType === 'col' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    if($startType === 'col' && $endType === 'col') {
      return 
        Grid::getGridColumnNumber($gridColumnEnd) - 
        Grid::getGridColumnNumber($gridColumnStart) + 1;
    }
    if($startType === 'col' && $endType === 'margin-left') {
      return 1;
    }
    if($startType === 'col' && $endType === 'margin-right') {
      return $gridTotalColumns - (Grid::getGridColumnNumber($gridColumnStart) - 1) + 1;
    }


    if($startType === 'margin-left' && $endType === 'auto') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd) + 1;
    }
    if($startType === 'margin-left' && $endType === 'span') {
      return Grid::getGridColumnSpanNumber($gridColumnEnd);
    }
    if($startType === 'margin-left' && $endType === 'col') {
      return 1 + Grid::getGridColumnNumber($gridColumnEnd);
    }
    if($startType === 'margin-left' && $endType === 'margin-right') {
      return 1 + $gridTotalColumns + 1;
    }
    if($startType === 'margin-left' && $endType === 'margin-left') {
      return 1;
    }
    if($startType === 'margin-right' && $endType === 'margin-right') {
      return 1;
    }
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