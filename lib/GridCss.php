<?php 

namespace auf;
use auf\Grid;

class GridCss extends Grid {

  public function headerCss() {
    $responsiveToStaticBreakpoint = $this->gridPreset()->responsiveToStaticBreakpointInPx() . 'px';
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
    $gridPreset = $this->gridPreset();
    $gridPresetClass = $gridPreset->uid();
    $gridPresetColumnWidth = $gridPreset->maxColumnWidthInPx() . 'px';
    $gridPresetColumnGap = $gridPreset->columnGapInPx() . 'px';
    $gridPresetColumnCount = $gridPreset->columnCount();
    $gridPresetRowGap = $gridPreset->rowGap();
    $oneColumnToResponsiveBreakpointInPx = $gridPreset->oneColumnToResponsiveBreakpointInPx() . 'px';
    return ('
  /* =========================== */
  /* GRID Presets / Default GRID */
  /* =========================== */

  :root {
    --grid-column-count: '.$gridPresetColumnCount.';
    --grid-column-width: '.$gridPresetColumnWidth.';
    --grid-column-gap: '  .$gridPresetColumnGap.';
    --grid-row-gap: '     .$gridPresetRowGap.';
  }

  .grid {
    display: grid;
    grid-template-columns: 
      [margin-left-start] 1fr [margin-left-end]
      repeat(var(--grid-column-count), [col-start] minmax(0, var(--grid-column-width)) [col-end]) 
      [margin-right-start] 1fr [margin-right-end];
    grid-column-gap: var(--grid-column-gap);
    column-gap: var(--grid-column-gap);
    grid-row-gap: var(--grid-row-gap);
    row-gap: var(--grid-row-gap);
  }

  .'.$gridPresetClass.' {
    --grid-column-count: ' . $gridPresetColumnCount . ';
    --grid-column-width: ' . $gridPresetColumnWidth . ';
    --grid-column-gap: '   . $gridPresetColumnGap . ';
    --grid-row-gap: '. $gridPresetRowGap . ';
  }

  .grid > * {
    grid-column-start: col-start 1; 
    grid-column-end: col-end 12;
  }

  .grid > .grid {
    grid-column-start: 1; 
    grid-column-end: -1;
  }

  @media screen and (max-width: '.$oneColumnToResponsiveBreakpointInPx.') {
    .grid {
      display: flex;
      flex-direction: column;
    }
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
  /* =========================== */
  /* GRID: Column Column Start-/End-Classes */
  /* =========================== */
');

    # ---------- Start Classes: START ----------------------------
    $startClassesCss = ('
  /* ------------------------- */
  /* grid__column--start */
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
  /* grid__column--end */
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
    $i = 1;
    foreach($spanClasses as $class => $value) {
      $spanClass = ('
  .grid--items--span-'.$i++.' > *,
  .'.$class. ' {
      grid-column-end: ' . $value. ';
  }
');
      $endClassesCss = $endClassesCss . $spanClass;
    }
    # ---------- End Classes: END ----------------------------

    return 
      $css . 
      $startClassesCss .
      $endClassesCss;
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
      $this->footerCss();
  }

  public function __toString()
  {
    return $this->css();
  }
}