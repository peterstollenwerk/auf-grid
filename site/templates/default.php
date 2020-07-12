<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page->title() ?></title>
  <?= css('assets/css/auf-grid.css') ?>
  <style>
    .box {
      padding: 1rem;
      border: 1px solid black;
    }
  </style>
</head>
<body class="grid">
  

  <h1><?= $page->title() ?></h1>
  <button><a href="<?= url('grid-tests') ?>">Visit Grid Test Page</a></button>

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


</body>
</html>
