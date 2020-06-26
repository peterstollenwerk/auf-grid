<?php 

use auf\Grid;

$grid = new Grid($site->grid_column_presets()->toStructure());

// var_dump($grid->getGridColumnSpanByPreset('grid__column--full'));
// var_dump($grid->getGridColumnSpanWidthInPx(3));
?>

<section>
  
  <h2>Grid Column Presets Preview</h2>

  <h3>Grid Preset Styles</h3>
  <pre><?= snippet('auf-grid/grid-preset-styles'); ?></pre>
  <style><?= snippet('auf-grid/grid-preset-styles'); ?></style>
  
  <h3>Grid Column Presets Styles</h3>
  <pre><?= snippet('auf-grid/grid-column-presets-styles'); ?></pre>
  <style><?= snippet('auf-grid/grid-column-presets-styles'); ?></style>

<?php
  
  $columnPresets = $grid->getGridColumnSitePresets();

  $gridPreset = $grid->gridPreset();

?>

<div class="grid <?= $gridPreset->uid() ?>">

<h3>Grid Preset: .<?= $gridPreset->uid() ?></h3>

<?php foreach($columnPresets as $columnPreset): ?>

  <?php
    $class = $columnPreset->grid_column_class();
  ?>

  <div class="<?= $class ?>">
    .<?= $class ?>
  </div>

<?php endforeach?>

</div>

</section>