<?php
  use auf\Grid;
  use auf\GridCss;
  use Kirby\Cms\Asset;
?>
<section>
  <h2>Generated Grid Styles</h2>
  <details>
    <summary style="padding: 1rem; cursor: pointer;">Show Generated Grid Styles</summary>
    <pre class="box">
      <?php
        $gridCss =  new GridCss($site->grid_column_presets()->toStructure());
      ?>
      <?= $gridCss; ?>
    </pre>
  </details>
</section>
<!-- ============================================= -->
<section class="grid">
  <h2>Inline Grids Tests</h2>
  <style>
    .boxes > * {
      padding: 1rem;
      border: 1px solid black;
    }
  </style>
  <div class="inline-grid boxes">
    <div>1</div>
    <div>2</div>
    <div>3</div>
    <div>4</div>
    <div>5</div>
    <div>6</div>
    <div>7</div>
    <div>8</div>
    <div>9</div>
    <div>10</div>
    <div>11</div>
    <div>12</div>
    <div>13</div>
    <div>14</div>
    <div>15</div>
  </div>


  <section class="grid">
    <h2>Inline Grid: Custom Start & End-Classes</h2>
    <h3>.inline-grid .grid__column--start-3 .grid__column--end-5</h3>
    <div class="inline-grid grid__column--start-1 grid__column--end-1 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--start-2 grid__column--end-3 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--start-4 grid__column--end-6 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--start-7 grid__column--end-10 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-5 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-6 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-7 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-8 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-9 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-10 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-11 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
    <div class="inline-grid grid__column--span-12 boxes">
      <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div>
      <div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
    </div>
  </section>
  

  <h2>.inline-grid.grid__column--preset Test</h2>
  <?php if($presets = $site->grid_column_presets()->toStructure()): ?>
    <?php foreach($presets as $preset): ?>
      <h3>.<?= $class = $preset->grid_column_class() ?></h3>
      <div class="inline-grid boxes <?= $class ?>">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>5</div>
        <div>6</div>
        <div>7</div>
        <div>8</div>
        <div>9</div>
        <div>10</div>
        <div>11</div>
        <div>12</div>
      </div>
    <?php endforeach?>
  <?php endif?>




  <h2>Inline Grid Items Span Test</h2>
  <?php 
    $grid = new Grid();
    $classes = $grid->inlineGridItemsSpanClasses();
  ?>
  <?php foreach($classes as $class): ?>
    <h3>.<?= $class ?></h3>
    <div class="inline-grid boxes <?= $class ?>">
      <div>1</div>
      <div>2</div>
      <div>3</div>
      <div>4</div>
      <div>5</div>
      <div>6</div>
      <div>7</div>
      <div>8</div>
      <div>9</div>
      <div>10</div>
      <div>11</div>
      <div>12</div>
    </div>
  <?php endforeach?>

</section>
<!-- ============================================= -->
<section class="grid">
  <h2>Align & Justify Helpers</h2>
  <?php
    $grid = new Grid();
    $asset = new Asset("assets/images/grid-test-2.jpg");

    ?>
    <h3>.items--span-3 inline-grid inline-grid--items--span-3 boxes align-items--center justify-items--center</h3>
    <div class="inline-grid inline-grid--items--span-3 align-items--center justify-items--center">
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(2)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(3)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?>
    </div>
    <h3>.items--span-3 .align-items--start .justify-items--end</h3>
    <div class="inline-grid inline-grid--items--span-3 align-items--start justify-items--end">
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(2)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(3)); ?>
      <?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?>
    </div>
    <h3>.items--span-3 .align-items--end .justify-items--start</h3>
    <div class="inline-grid inline-grid--items--span-3 align-items--end justify-items--start">
      <div><?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?></div>
      <div><?php echo $asset->resize($grid->getColumnSpanWidthInPx(2)); ?></div>
      <div><?php echo $asset->resize($grid->getColumnSpanWidthInPx(3)); ?></div>
      <div><?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?></div>
      <div class="align-self--center justify-self--center"><?php echo $asset->resize($grid->getColumnSpanWidthInPx(1)); ?></div>
      <div><?php echo $asset->resize($grid->getColumnSpanWidthInPx(3)); ?></div>
    </div>

</section>
<!-- ============================================= -->
<section class="grid">
  <h2>Inline Grid Breakpoint Test</h2>
  <section class="inline-grid inline-grid--items--span-4 boxes">
    <article>
      <h2>Article 1</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores quaerat, provident beatae, assumenda nulla quidem, eius dolorum temporibus vel iure natus aut delectus? Alias placeat quis maxime repellat qui odit?</p>
      <button><a href="#">Read Article 1</a></button>
    </article>
    <article>
      <h2>Article 2</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores quaerat, provident beatae, assumenda nulla quidem, eius dolorum temporibus vel iure natus aut delectus? Alias placeat quis maxime repellat qui odit?</p>
      <button><a href="#">Read Article 2</a></button>
    </article>
    <article>
      <h2>Article 3</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores quaerat, provident beatae, assumenda nulla quidem, eius dolorum temporibus vel iure natus aut delectus? Alias placeat quis maxime repellat qui odit?</p>
      <button><a href="#">Read Article 3</a></button>
    </article>
  </section>
</section>
<!-- ============================================= -->
<section class="grid boxes">
  <h2>outset helper test</h2>
  <h3 class="outset">outset</h3>
  <h3 class="outset--left">outset--left</h3>
  <h3 class="outset--right">outset--right</h3>
  <section class="inline-grid outset--items boxes" style="padding: initial; border: none;">
    <h4>inline-grid outset--items</h4>
    <div class="grid__column--start-3">1</div>
    <div class="grid__column--start-5">2</div>
    <div class="grid__column--start-7">3</div>
  </section>
  <section class="inline-grid outset--items--left boxes" style="padding: initial; border: none;">
    <h4>inline-grid outset--items--left</h4>
    <div class="grid__column--start-3">1</div>
    <div class="grid__column--start-5">2</div>
    <div class="grid__column--start-7">3</div>
  </section>
  <section class="inline-grid outset--items--right boxes" style="padding: initial; border: none;">
    <h4>inline-grid outset--items--right</h4>
    <div class="grid__column--start-3">1</div>
    <div class="grid__column--start-5">2</div>
    <div class="grid__column--start-7">3</div>
  </section>
</section>
<!-- ============================================= -->
<section>
  <h2>Grid Images</h2>
  <style>
    img { display: block; }
    </style>
  <?php
    $grid = new Grid();
    $columns = 12;
    $asset = new Asset("assets/images/grid-test-1.jpg");

    for ($i=1; $i <= $columns; $i++) { 
      echo '<h3>span '.$i.'</h3>';
      echo $asset->resize($grid->getColumnSpanWidthInPx($i));
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
      <td><?= $grid->getColumnSpanByPreset('grid__column--medium') ?></td>
      <td><?= $grid->getColumnSpanWidthInPx($grid->getColumnSpanByPreset('grid__column--medium')) ?></td>
    </tr>
    <tr>
      <td>grid__column--DOES_NOT_EXIST</td>
      <td><?= $grid->getColumnSpanByPreset('grid__column--DOES_NOT_EXIST'); ?></td>
      <td><?= $grid->getColumnSpanWidthInPx($grid->getColumnSpanByPreset('grid__column--DOES_NOT_EXIST')) ?></td>
    </tr>
  </table>
</section>
<!-- ============================================= -->
<section class="grid">
  <h2>Grid Presets Preview</h2>
  <?php
    $columnPresets = $grid->getGridColumnSitePresets();
  ?>
  <div class="grid">
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
<section class="grid">
  <h3>Custom Column Start- & End Class Matrix</h3>
  <?php 
    $startClasses = Grid::$gridColumnStartClassesCssValueMapping;
    $endClasses = Grid::$gridColumnEndClassesCssValueMapping;
  ?>
  <div class="grid">
    <?php foreach($startClasses as $startClass => $value): ?>
      <?php foreach($endClasses as $endClass => $value): ?>
        <div class="<?= $startClass ?> <?= $endClass ?>" style="overflow: hidden;">
          .<?= $startClass ?> 
          <br>
          .<?= $endClass ?>
        </div>
      <?php endforeach?>
    <?php endforeach?>
  </div>
</section>
<!-- ============================================= -->