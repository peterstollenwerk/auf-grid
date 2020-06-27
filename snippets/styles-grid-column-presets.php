<?php

use auf\Grid;

$grid = new Grid($site->grid_column_presets()->toStructure());

foreach($grid->getGridColumnSitePresets() as $preset) {

  snippet('auf-grid/styles-grid-column-preset', ['preset' => $preset]);

}
?> 