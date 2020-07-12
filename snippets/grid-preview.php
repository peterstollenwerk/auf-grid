<section>
  <h2>Generated Grid Styles</h2>
  <pre class="box">
    <?php
      use auf\GridCss;
      $gridCss =  new GridCss($site->grid_column_presets()->toStructure());
    ?>
    <?= $gridCss; ?>
  </pre>
</section>
<!-- ============================================= -->
<section>
  <h2>Grid Images</h2>
  <style>
    img { display: block; }
    </style>
  <?php
    use auf\Grid;
    use Kirby\Cms\Asset;
    
    $grid = new Grid();
    $columns = 12;
    $asset = new Asset("assets/images/grid-test-1.jpg");

    for ($i=1; $i <= $columns; $i++) { 
      echo $asset->resize($grid->getGridColumnSpanWidthInPx($i));
    }
  ?>
</section>
<!-- ============================================= -->
<section>
  <h2>Grid Column Presets of this Site</h2>
  <style>
    table {
      border-collapse: collapse;
      border: 2px solid black;
    }
    table th, table td {
      text-align: left;
      padding: 0.5rem;
      border: 1px solid black;
    }
  </style>
  <table>
    <tr>
        <th>grid_column_class</th>
        <th>grid_column_label</th>
        <th>grid_column_start_class</th>
        <th>grid_column_end_class</th>
    </tr>
    <?php foreach($site->grid_column_presets()->toStructure() as $preset): ?>
      <tr>
        <td><?= $preset->grid_column_class(); ?></td>
        <td><?= $preset->grid_column_label(); ?></td>
        <td><?= $preset->grid_column_start_class(); ?></td>
        <td><?= $preset->grid_column_end_class(); ?></td>
      </tr>
    <?php endforeach?>
  </table>
</section>
<!-- ============================================= -->
<section>
  <h2>Getting Column Span Of A Preset</h2>
  <?php 
    $grid = new Grid($site->grid_column_presets()->toStructure());
  ?>
  <table>
    <tr>
      <th>grid_column_class</th>
      <th>span</th>
      <th>width in px</th>
    </tr>
    <tr>
      <td>grid__column--medium</td>
      <td><?= $grid->getGridColumnSpanByPreset('grid__column--medium') ?></td>
      <td><?= $grid->getGridColumnSpanWidthInPx($grid->getGridColumnSpanByPreset('grid__column--medium')) ?></td>
    </tr>
    <tr>
      <td>grid__column--DOES_NOT_EXIST</td>
      <td><?= $grid->getGridColumnSpanByPreset('grid__column--DOES_NOT_EXIST'); ?></td>
      <td><?= $grid->getGridColumnSpanWidthInPx($grid->getGridColumnSpanByPreset('grid__column--DOES_NOT_EXIST')) ?></td>
    </tr>
  </table>
</section>
<!-- ============================================= -->
<section class="grid">
  <h2>Grid Presets Preview</h2>
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
</section>
<!-- ============================================= -->
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
<!-- ============================================= -->