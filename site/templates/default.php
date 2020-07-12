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


    .inline-grid {
      --grid-row-gap: var(--grid-column-gap);
      display: inline-grid;
      grid-template-columns: 
      repeat(var(--grid-column-count), [col-start] minmax(0, var(--grid-column-width)) [col-end]);
      grid-column-gap: var(--grid-column-gap);
      column-gap: var(--grid-column-gap);
      grid-row-gap: var(--grid-row-gap);
      row-gap: var(--grid-row-gap);
    }
    .inline-grid > * {
      margin-top: initial;
    }
    .inline-grid.grid__column--aside  { --grid-column-count: 5; }
    .inline-grid.grid__column--main   { --grid-column-count: 7; }
    .inline-grid.grid__column--small  { --grid-column-count: 8; }
    .inline-grid.grid__column--medium { --grid-column-count: 10; }
    .inline-grid.grid__column--large  { --grid-column-count: 12; }
    
    .inline-grid.grid__column--full {
      grid-template-columns: 
      repeat(var(--grid-column-count), [col-start] minmax(0, 1fr) [col-end]);
    }
    .inline-grid.grid__column--full  {
      grid-column-start: 1;
      grid-column-end: -1;
    }


  </style>
</head>
<body class="grid">
  <h1><?= $page->title() ?></h1>
  <a class="" href="<?= url('grid-tests') ?>"><button>Visit Grid Test Page</button></a>
  <a href="<?= url('#grid') ?>">Show Grid: Simply add #grid behind the url to show a grid-overlay</a>
  <hr>
  <h1>DON´T FORGET TO SAVE THE CSS TO DISK</h1>
  <ul 
    class="boxes grid__column--small inline-grid grid--items--span-2">
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
