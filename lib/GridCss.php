<?php 

namespace auf;
use auf\Grid;
use Kirby\Cms\File;



class GridCss extends Grid {

  public function headerCss() {
    $responsiveToStaticBreakpoint = $this->responsiveToStaticBreakpointInPx() . 'px';
    return ('
.grid {
  max-width: '. $responsiveToStaticBreakpoint.';
  margin-left: auto;
  margin-right: auto; 
}

@supports (grid-area: auto) { /* only load grid for supported browsers */

  /* Grid // @supports start */
  
  .grid { /* reset */
    max-width: initial;
    margin-left: initial;
    margin-right: initial;
  }
    ');
  }

  public function gridPresetCss() {
    $gridPresetClass = 'grid--default';
    $gridPresetColumnWidth = $this->maxColumnWidthInPx() . 'px';
    $gridPresetColumnGap = $this->columnGapInPx() . 'px';
    $gridPresetColumnCount = $this->columnCount();
    $gridPresetRowGap = $this->rowGap();
    $oneColumnToResponsiveBreakpointInPx = $this->oneColumnToResponsiveBreakpointInPx() . 'px';
    return ('
  /* =========================== */
  /* GRID                        */
  /* =========================== */

  :root {
    --grid-column-count: ' . $gridPresetColumnCount . ';
    --grid-column-max-width: ' . $gridPresetColumnWidth . ';
    --grid-column-gap: '   . $gridPresetColumnGap . ';
    --grid-row-gap: '. $gridPresetRowGap . ';
  }

  .grid {
    display: grid;
    grid-template-columns: 
      [margin-left-start] 1fr [margin-left-end]
      repeat(var(--grid-column-count), [col-start] minmax(0, var(--grid-column-max-width)) [col-end]) 
      [margin-right-start] 1fr [margin-right-end];
    grid-column-gap: var(--grid-column-gap);
    column-gap: var(--grid-column-gap);
    grid-row-gap: var(--grid-row-gap);
    row-gap: var(--grid-row-gap);
  }

  .grid > * {
    grid-column-start: col-start 1; 
    grid-column-end: col-end '.$gridPresetColumnCount.';
  }

  .grid > .grid {
    grid-column-start: 1; 
    grid-column-end: -1;
  }
');
  }

  public function gridColumnPresetsCss() {

    $gridColumnPresets = $this->getGridColumnSitePresets();

    if(!$gridColumnPresets) {
      return;
    }

    $css = ('
  /* =========================== */
  /* GRID Column Presets */
  /* =========================== */
    ');

    foreach($gridColumnPresets as $preset) {
      $gridColumnClass = $preset->grid_column_class();
      $gridColumnStartClass = $preset->grid_column_start_class();
      $gridColumnEndClass = $preset->grid_column_end_class();
      $gridColumnStartCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnStartClass);
      $gridColumnEndCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnEndClass);
      $presetCss = ('
  .'.$gridColumnClass.' {
    grid-column-start: '. $gridColumnStartCss .';
    grid-column-end: '. $gridColumnEndCss . ';
  }
');
      $css  = $css . $presetCss;
    }

    return $css;

  }
  public function gridColumnStartEndClassesCss() {
    $startClasses = Grid::$gridColumnStartClassesCssValueMapping;
    $endClasses = Grid::$gridColumnEndClassesCssValueMapping;
    $spanClasses = Grid::$gridColumnSpanClassesCssValueMapping;

    
    $css = ('
  /* ====================================== */
  /* GRID: Column Column Start-/End-Classes */
  /* ====================================== */
');

    # ---------- Start Classes: START ----------------------------
    $startClassesCss = ('
  /* ------------------------- */
  /* grid__column--start-#     */
  /* ------------------------- */
'); 
    foreach($startClasses as $class => $value) {
      $startClass = ('
  .'.$class. ' {
      grid-column-start: ' . $value. ';
  }
');
    $startClassesCss = $startClassesCss . $startClass;
    }
    # ---------- Start Classes: END ----------------------------

    # ---------- End Classes: START ----------------------------
    $endClassesCss = ('
  /* ------------------------- */
  /* grid__column--end-#       */
  /* ------------------------- */
'); 
    foreach($endClasses as $class => $value) {
      $endClass = ('
  .'.$class. ' {
      grid-column-end: ' . $value. ';
  }
');
      $endClassesCss = $endClassesCss . $endClass;
    }
    # ---------- span classes  (secondary end-classes)----------------------------
    $spanClassesCss = ('
    /* ------------------------- */
    /* grid__column--span-#      */
    /* ------------------------- */
  '); 
    foreach($spanClasses as $class => $value) {
      $spanClass = ('
  .'.$class. ' {
      grid-column-end: ' . $value. ';
  }
');
      $spanClassesCss = $spanClassesCss . $spanClass;
    }
    # ---------- End Classes: END ----------------------------

    return 
      $css . 
      $startClassesCss .
      $endClassesCss .
      $spanClassesCss;
  }

  public function inlineGridCss() {

    $inlineGridCss = file_get_contents('css/inline-grid.css', true);

    # --------------------------------------------------------------
    $inlineGridItemsSpanClassesCss = '
  
  /* ------------------------------- */
  /* inline-grid--items--span-#       */  
  /* ------------------------------- */
    ';
    for($i = 1; $i <= $this->columnCount(); $i++) {
      $classCss = ('
  .' . Grid::$inlineGridItemsSpanClassPrefix . $i .' > * {
    grid-column-end: span '. $i .';
  }
      ');
      $inlineGridItemsSpanClassesCss = $inlineGridItemsSpanClassesCss . $classCss;
    }
    return $inlineGridCss . $inlineGridItemsSpanClassesCss;

  }

  public function inlineGridColumnPresetsCss() {
    $gridColumnPresets = $this->getGridColumnSitePresets();

    if(!$gridColumnPresets) {
      return;
    }

    $css = ('
  /* =========================== */
  /* INLINE-GRID Column Presets */
  /* =========================== */
    ');
    foreach($gridColumnPresets as $preset) {
      $gridColumnClass = $preset->grid_column_class();
      $gridColumnStartClass = $preset->grid_column_start_class();
      $gridColumnEndClass = $preset->grid_column_end_class();
      $gridColumnStartCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnStartClass);
      $gridColumnEndCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnEndClass);
      $presetColumnSpan = $this->getColumnSpanByPreset($gridColumnClass);
      $presetCss = '';
      if($gridColumnClass != 'grid__column--full') {
        $presetCss = ('
  .'.$gridColumnClass.'.inline-grid {
    --grid-column-count: '.$presetColumnSpan.';
    grid-column-start: '. $gridColumnStartCss .';
    grid-column-end: '. $gridColumnEndCss . ';
  }
        ');
      } else {
        $presetCss = ('
  .grid__column--full.inline-grid {
    grid-column-start: 1;
    grid-column-end: -1;
  }
        ');

      }
      $css = $css . $presetCss;
    }
    return $css;
  }

  public function alignJustifyHelpersCss() {

    return file_get_contents('css/align-justify-helpers.css', true);

  }


  public function mediaQueriesCss() {
    return ('
  
  /* ============================== */
  /* MEDIA-QUERIES */
  /* ============================== */

  @media screen and (max-width: '.$this->oneColumnToResponsiveBreakpointInPx().'px) {
    .grid,
    .inline-grid {
      display: flex;
      flex-direction: column;
    }
  }    
');
  }

  public function footerCss() {
    return ('
  /* Grid // @supports end */

}
    ');
  }
  
  public function css() {
    return 
      $this->headerCss() . 
      $this->gridPresetCss() . 
      $this->gridColumnPresetsCss() . 
      $this->gridColumnStartEndClassesCss() .
      $this->inlineGridCss() .
      $this->inlineGridColumnPresetsCss() .
      $this->alignJustifyHelpersCss() .
      $this->mediaQueriesCss() .
      $this->footerCss();
  }

  public function __toString()
  {
    return $this->css();
  }
}