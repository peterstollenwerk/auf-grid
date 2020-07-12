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
      .grid {
          background-color: hsl(25, 00%, 50%);
        }
      .grid > *:not(.grid) {
        background-color: white;
        outline: 2px dashed black;
      }
      section {
        margin-top: 3rem;
      }
    </style>
  </head>
  <body class="grid">
    <h1><?= $page->title() ?></h1>
    <?= snippet('auf-grid/grid-preview'); ?>
  </body>
</html>