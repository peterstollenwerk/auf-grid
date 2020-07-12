<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page->title() ?></title>
    <?= css('assets/css/auf-grid.css') ?>
    <style>
      * + * {
        margin-top: 1rem;
      }
      .grid > *:not(.grid) {
        background-color: hsla(25, 100%, 00%, 0.25);
        outline: 1px dashed black;
      }
      section {
        margin-top: 3rem;
      }
    </style>
  </head>
  <body class="grid">
    <h1><?= $page->title() ?></h1>
    <a href="<?= url('#grid') ?>">Show Grid: Simply add #grid behind the url to show a grid-overlay</a>
    <?= snippet('auf-grid/grid-preview'); ?>
    <?= snippet('auf-grid/grid-overlay'); ?>
  </body>
</html>