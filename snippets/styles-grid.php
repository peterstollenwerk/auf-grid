<?php
  use auf\Grid;
  $grid = new Grid();
  $gridPreset = $grid->gridPreset();
  $responsiveToStaticBreakpointInPx = $gridPreset->responsiveToStaticBreakpointInPx() . 'px';
?>

.grid {
  max-width: <?= $responsiveToStaticBreakpointInPx ?>;
  margin-left: auto;
  margin-right: auto;
}

@supports (grid-area: auto) { /* only apply grid for supported browsers */

/* @supports start */


    .grid { /* reset */
      max-width: initial;
      margin-left: initital;
      margin-right: initial;
    }

    /* ======================= */
    /* GRID */
    /* ======================= */
    <?= snippet('auf-grid/styles-grid-preset'); ?>

    /* ======================= */
    /* GRID: Column Presets */
    /* ======================= */
    <?= snippet('auf-grid/styles-grid-column-presets'); ?>
    


    /* ======================= */
    /* GRID: Column Column Start-/End-Classes */
    /* ======================= */
    
    <?= snippet('auf-grid/styles-grid-column-start-end-span-classes'); ?>

/* @supports end */

}