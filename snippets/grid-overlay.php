<?php
  use auf\Grid;
  $grid = new Grid();
  $columns = $grid->columnCount();
  $i = 1;
?>

<style>
  .grid--overlay {
    display: grid;
    margin: initial;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    background-color: transparent !important;
  }
  .grid--overlay > * {
    margin-top: initial;
    grid-column-start: auto;
    grid-column-end: auto;
    color: fuchsia !important;
    background-color: transparent !important;
    outline: 1px dashed fuchsia !important;
    text-align: center;
    font-weight: bold;
  }
  .grid--overlay--hidden {
    display: none;
  }
</style>

<div class="grid grid--overlay grid--overlay--hidden">
  <div data-hint="margin-left"></div>
  <?php for($i; $i <= $columns; $i++ ): ?>
    <div><?= $i ?></div>
  <?php endfor?>
  <div data-hint="margin-right"></div>
</div>

<script>
(function() {

  const overlayEl = document.getElementsByClassName('grid--overlay')[0];

  function showGridOverlay() {
    overlayEl.classList.remove('grid--overlay--hidden');
  }
  function hideGridOverlay() {
    overlayEl.classList.add('grid--overlay--hidden');
  }
  function hashHandler() {
    if (window.location.hash == '#grid') {
      showGridOverlay();      
    } else {
      hideGridOverlay();      
    }
  }
  
  window.addEventListener('hashchange', hashHandler, false);
  hashHandler();

})()
</script>
