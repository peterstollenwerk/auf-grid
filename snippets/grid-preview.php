<ul>
  <?php foreach($site->grid_column_presets()->toStructure() as $preset): ?>
    <li><?= $preset->grid_column_class(); ?></li>
  <?php endforeach?>
</ul>

<?php

  $asidePreset = $site->grid_column_presets()->toStructure()->findBy('grid_column_class', 'grid__column--aside');
  var_dump($asidePreset->grid_column_class()->value());

?>

<?php 
use auf\Grid;
$grid = new Grid($site->grid_column_presets()->toStructure());
var_dump($grid->getGridColumnSpanByPreset('grid__column--aside'));
var_dump($grid->getGridColumnSpanWidthInPx(3));
?>

<style>
  .grid {
    background-color: hsl(25, 50%, 50%);
  }
  .grid > * {
    background-color: white;
    outline: 2px dashed black;
  }
</style>

<h2>Grid Column Presets Preview</h2>
<!-- ============================================= -->
<!-- Grid Styles: Start  -->
<section>
  <h3>Grid Styles</h3>
  <pre><?= snippet('auf-grid/styles-grid'); ?></pre>
  <style><?= snippet('auf-grid/styles-grid'); ?></style>
</section>
<!-- ============================================= -->
<!-- Grid Presets. Start -->
<section>
  <?php
    $columnPresets = $grid->getGridColumnSitePresets();
    $gridPreset = $grid->gridPreset();
  ?>
  <h3>Grid Column Presets: .<?= $gridPreset->uid() ?></h3>
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
</section>
<!-- ============================================= -->
<!-- Grid Column Starts: Start -->
<section>

  <h3>Custom Column Start- & End Class Matrix</h3>
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