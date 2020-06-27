<?php

use auf\Grid;

$gridColumnClass = $preset->grid_column_class();

$gridColumnStartClass = $preset->grid_column_start_class();
$gridColumnEndClass = $preset->grid_column_end_class();

$gridColumnStartCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnStartClass);
$gridColumnEndCss = Grid::getCssValueForGridColumnStartEndClass($gridColumnEndClass);

?>

.<?= $gridColumnClass; ?> {
  grid-column-start: <?= $gridColumnStartCss ?>;
  grid-column-end: <?= $gridColumnEndCss ?>;
}