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
    .box,
    .boxes > * {
      padding: 1rem;
      border: 1px solid black;
    }
    ul.boxes {
      margin: initial;
      padding: initial;
      list-style: none;
    }
  </style>
</head>
<body class="grid">

  <h1><?= $page->title() ?></h1>
  <button class="grid__column--span-5"><a class="" href="<?= url('grid-tests#grid') ?>">Visit Grid Test Page</a></button>
  <a href="<?= url('#grid') ?>">Show Grid: Simply add #grid behind the url to show a grid-overlay</a>
  <hr>
  <ul 
    class="boxes grid__column--small inline-grid inline-grid--items--span-2">
    <li>One</li>
    <li>Two</li>
    <li>Three</li>
    <li>Four</li>
    <li>Five</li>
    <li>Six</li>
  </ul>
  <?= snippet('auf-grid/grid-overlay'); ?>
</body>
</html>
