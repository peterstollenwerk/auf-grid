<?php

use auf\Grid;

$grid = new Grid($site->grid_column_preset()->toStructure());

$columnPresets = $grid->getGridColumnSitePresets();
echo '<h2>ABCD</h2>';

foreach($columnPresets as $preset) {

}
?> 
