<h1><?= $page->title() ?></h1>
<?= $page->aufpluginfield() ?>


<?php 

use auf\Grid;

$grid = new Grid();

var_dump($grid->getGridColumnSpanByPreset('grid__column--full'));

var_dump($grid->getGridColumnSpanWidthInPx(3));

