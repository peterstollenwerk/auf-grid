<?php

use auf\Grid;

$grid = new Grid();

$gridPreset = $grid->gridPreset();
$gridPresetClass = $gridPreset->uid();
$gridPresetColumnWidth = $gridPreset->maxColumnWidthInPx() . 'px';
$gridPresetColumnGap = $gridPreset->columnGapInPx() . 'px';
$gridPresetColumnCount = $gridPreset->columnCount();
$gridPresetRowGap = $gridPreset->rowGap();

$styles = '

.grid {
  --grid-column-count: ' . $gridPresetColumnCount . ';
  --grid-column-width: ' . $gridPresetColumnWidth . ';
  --grid-column-gap: '   . $gridPresetColumnGap . ';
  --grid-row-gap: '      . $gridPresetRowGap . ';

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

.'. $gridPresetClass .' {
  --grid-column-count: ' . $gridPresetColumnCount . ';
  --grid-column-width: ' . $gridPresetColumnWidth . ';
  --grid-column-gap: '   . $gridPresetColumnGap . ';
  --grid-row-gap: '. $gridPresetRowGap . ';
}

.grid > * {
  grid-column: -2 / -2;
  outline: 1px dashed black;
}


';
?>

<?= $styles ?>