<?php

use auf\Grid;

$startClasses = Grid::$gridColumnStartClassesCssValueMapping;
$endClasses = Grid::$gridColumnEndClassesCssValueMapping;
$spanClasses = Grid::$gridColumnSpanClassesCssValueMapping;

?>
/* ------------------------- */
/* grid__column--start */
/* ------------------------- */
<?php foreach($startClasses as $class => $value): ?>
.<?= $class ?> {
  grid-column-start: <?= $value ?>;
}
<?php endforeach?>
/* ------------------------- */
/* grid__column--end */
/* ------------------------- */
<?php foreach($endClasses as $class => $value): ?>
.<?= $class ?> {
  grid-column-end: <?= $value ?>;
}
<?php endforeach?>

<?php foreach($spanClasses as $class => $value): ?>
.<?= $class ?> {
  grid-column-end: <?= $value ?>;
}
<?php endforeach?>

