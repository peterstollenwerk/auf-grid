<?php

use auf\Grid;

$grid = new Grid($site->grid_column_presets()->toStructure());

foreach($grid->getGridColumnSitePresets() as $preset) {

  snippet('auf-grid/grid-column-preset-style', ['preset' => $preset]);

}
?> 
.grid__column--main {
  grid-column-start: col-start 6;
  grid-column-end: col-end 12;
}
.grid__column--aside {
  grid-column-start: col-start 1;
  grid-column-end: col-end 5;
}