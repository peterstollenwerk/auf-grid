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
  
  <h3>Grid Column Presets Style</h3>
  <pre><?= snippet('auf-grid/grid-column-presets-styles'); ?></pre>
  <style><?= snippet('auf-grid/grid-column-presets-styles'); ?></style>
  
  <h3>Grid Column Classes Style</h3>
  <pre><?= snippet('auf-grid/grid-column-classes-style'); ?></pre>
  <style><?= snippet('auf-grid/grid-column-classes-style'); ?></style>

<?php
  
  $columnPresets = $grid->getGridColumnSitePresets();

  $gridPreset = $grid->gridPreset();

?>

<h3>Grid Preset: .<?= $gridPreset->uid() ?></h3>

<div class="grid <?= $gridPreset->uid() ?>">


<?php foreach($columnPresets as $columnPreset): ?>

  <?php
    $class = $columnPreset->grid_column_class();
  ?>

  <div class="<?= $class ?>">
    .<?= $class ?>
  </div>

<?php endforeach?>

</div>



<h3>Custom Column Starts</h3>

<?php 

  $startClasses = Grid::$gridColumnStartClassesCssValueMapping;
  $endClasses = Grid::$gridColumnEndClassesCssValueMapping;

?>

<div class="grid">

  <?php foreach($startClasses as $startClass => $value): ?>

    <?php foreach($endClasses as $endClass => $value): ?>

      <div class="<?= $startClass ?> <?= $endClass ?>">
        .<?= $startClass ?> 
        <br>
        .<?= $endClass ?>
      </div>

    <?php endforeach?>

  <?php endforeach?>

</div>

</section>