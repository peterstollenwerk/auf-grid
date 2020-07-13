<?php 

namespace auf;

use auf\GridPreset;
use auf\GridColumnPreset;
use Kirby\Cms\Structure;
use Kirby\Data\Json;
use Kirby\Data\Yaml;
use Kirby\Toolkit\F;

class Grid {

  static $inlineGridItemsSpanClassPrefix = 'inline-grid--items--span-';

  public function inlineGridItemsSpanClasses ($prefix = NULL) {
    $prefix = $prefix ?? Grid::$inlineGridItemsSpanClassPrefix;
    $classes = [];
    for($i = 1; $i <= $this->columnCount(); $i++) {
      array_push($classes, ($prefix.$i));
    }
    return $classes;
  }

  static $gridColumnCustomClass = 'grid__column--custom';

  static $gridColumnStartClassesCssValueMapping = [
    
    'grid__column--start-margin-left' => 'margin-left-start',
    
    'grid__column--start-1'  => 'col-start 1',
    'grid__column--start-2'  => 'col-start 2',
    'grid__column--start-3'  => 'col-start 3',
    'grid__column--start-4'  => 'col-start 4',
    'grid__column--start-5'  => 'col-start 5',
    'grid__column--start-6'  => 'col-start 6',
    'grid__column--start-7'  => 'col-start 7',
    'grid__column--start-8'  => 'col-start 8',
    'grid__column--start-9'  => 'col-start 9',
    'grid__column--start-10' => 'col-start 10',
    'grid__column--start-11' => 'col-start 11',
    'grid__column--start-12' => 'col-start 12',
    
    'grid__column--start-margin-right' => 'margin-right-start',
    
    'grid__column--start-auto' => 'auto'
  ];

  static $gridColumnEndClassesCssValueMapping = [

    'grid__column--end-margin-left' => 'margin-left-end',
    
    'grid__column--end-1'  => 'col-end 1',
    'grid__column--end-2'  => 'col-end 2',
    'grid__column--end-3'  => 'col-end 3',
    'grid__column--end-4'  => 'col-end 4',
    'grid__column--end-5'  => 'col-end 5',
    'grid__column--end-6'  => 'col-end 6',
    'grid__column--end-7'  => 'col-end 7',
    'grid__column--end-8'  => 'col-end 8',
    'grid__column--end-9'  => 'col-end 9',
    'grid__column--end-10' => 'col-end 10',
    'grid__column--end-11' => 'col-end 11',
    'grid__column--end-12' => 'col-end 12',
    
    'grid__column--end-margin-right' => 'margin-right-end',
    
    'grid__column--end-auto' => 'auto',

  ];
  static $gridColumnSpanClassesCssValueMapping = [
    'grid__column--span-1' => 'span 1',
    'grid__column--span-2' => 'span 2',
    'grid__column--span-3' => 'span 3',
    'grid__column--span-4' => 'span 4',
    'grid__column--span-5' => 'span 5',
    'grid__column--span-6' => 'span 6',
    'grid__column--span-7' => 'span 7',
    'grid__column--span-8' => 'span 8',
    'grid__column--span-9' => 'span 9',
    'grid__column--span-10' => 'span 10',
    'grid__column--span-11' => 'span 11',
    'grid__column--span-12' => 'span 12'
  ];

  static function gridColumnStartEndClassesCssValueMapping() {
    return array_merge(
      Grid::$gridColumnStartClassesCssValueMapping,
      Grid::$gridColumnEndClassesCssValueMapping,
      Grid::$gridColumnSpanClassesCssValueMapping
    );
  }

  static function getCssValueForGridColumnStartEndClass($class) {
    $classes = Grid::gridColumnStartEndClassesCssValueMapping();
    return $classes[(string)$class];
  }
  

  // MAPPINGS END

  

  private $id;
  public function id() { return $this->id; }

  private $columnCount;
  public function columnCount() { return $this->columnCount; }
  
  private $maxColumnWidthInPx;
  public function maxColumnWidthInPx() { return $this->maxColumnWidthInPx; }
  
  private $columnGapInPx;
  public function columnGapInPx() { return $this->columnGapInPx; }
  
  private $oneColumnToResponsiveBreakpointInPx;
  public function oneColumnToResponsiveBreakpointInPx() { return $this->oneColumnToResponsiveBreakpointInPx; }
  
  private $rowGap;
  public function rowGap() { return $this->rowGap; }

  private $columnGapsCount;
  public function columnGapsCount() { return $this->columnGapsCount; }
  
  private $responsiveToStaticBreakpointInPx;
  public function responsiveToStaticBreakpointInPx() { return $this->responsiveToStaticBreakpointInPx; }

  private $gridColumnDefaultPreset;
  private $gridColumnSitePresets;

  public function __construct(Structure $grid_column_presets = NULL) {

    $gridPreset = new GridPreset();

    $this->id = $gridPreset->id;
    $this->columnCount = $gridPreset->columnCount;
    $this->maxColumnWidthInPx = $gridPreset->maxColumnWidthInPx;
    $this->columnGapInPx = $gridPreset->columnGapInPx;
    $this->oneColumnToResponsiveBreakpointInPx = $gridPreset->oneColumnToResponsiveBreakpointInPx;
    $this->rowGap = $gridPreset->rowGap;
    $this->columnGapsCount = $gridPreset->columnGapsCount;
    $this->responsiveToStaticBreakpointInPx = $gridPreset->responsiveToStaticBreakpointInPx;

    $this->gridColumnDefaultPreset = new GridColumnPreset( 
      $gridColumnClass = 'grid__column--default',
      $gridColumnStartColumnClass = 'grid__column--start-1',
      $gridColumnEndColumnClass = 'grid__column--end-12',
      $gridColumnLabel = 'Default'
    );

    if($grid_column_presets) {
      $this->gridColumnSitePresets  = $grid_column_presets;
    }

  }

  public function gridColumnDefaultPreset() { 
    return $this->gridColumnDefaultPreset; 
  }

  public function getGridColumnSitePresets() {
    return $this->gridColumnSitePresets;
  }

  public function getGridColumnPresetByColumnClass(string $grid_column_class = '') {
    if($columnPresets = $this->getGridColumnSitePresets()) {
      $preset = $columnPresets->findBy('grid_column_class', $grid_column_class);
    }
    return $preset ? $preset : $this->gridColumnDefaultPreset();
  }

  public function getColumnSpanByPreset(string $grid_column_class = '') {
    $preset = $this->getGridColumnPresetByColumnClass($grid_column_class);
    return $this->getColumnSpanByStartAndEndColumnClasses($preset->grid_column_start_class(), $preset->grid_column_end_class());
  }

  public function getColumnSpanWidthInPx($columnSpan) {
    return (
      $columnSpan * $this->maxColumnWidthInPx() + 
      ($columnSpan - 1) * $this->columnGapInPx()
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

  public function getColumnSpanByStartAndEndColumnClasses(

    string $gridColumnStart = 'grid__column--start-1', 
    string $gridColumnEnd   = 'grid__column--end-12',
    $gridTotalColumns = NULL

    ) {
      
    if($gridTotalColumns === NULL) {
      $gridTotalColumns = $this->columnCount();
    }
    $startType = Grid::getGridColumnStartEndType($gridColumnStart);
    $endType   = Grid::getGridColumnStartEndType($gridColumnEnd);
    
    $gridColumnDefaultStartClass = $this->gridColumnDefaultPreset()->gridColumnStartClass();
    $gridColumnDefaultEndClass = $this->gridColumnDefaultPreset()->gridColumnEndClass();

    # AUTO
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
    # COLS
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
    # MARGIN-LEFT
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
    # MARGIN-RIGHT
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
  
  static function writeCssFile($gridColumnPresets = NULL) {
    $file = kirby()->root('assets') . '/css/auf-grid.css';
    $grid = new GridCss($gridColumnPresets);
    F::write($file, $grid->css());
  }

}