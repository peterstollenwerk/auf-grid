# auf-grid

## Installation

### CSS Setup

Include the generated grid styles in the head of your document:

```php
<style>
  <?= css('assets/css/auf-grid.css') ?>
</style>
```
After you changed the grid settings, you have to regenerate the file in the Grid dedicated panel view;

### Grid Column Presets Site Setup

If you want to create custom column presets you can do so.
Implement our grid_settings section somewhere in your site.yml:

```site.yml
title: Site

tabs:
  settings:
    sections:
      grid_settings: auf_grid/grid_settings
```

### Setup your component blueprint (i.e. builder-block)

```
fields:
  grid_section_headline:
    type: headline
    label: Grid System
  
  grid_column_preset:
    extends: grid_column_preset

  grid_column_start_class:
    extends: auf_grid/fields/grid_column_start_class
    width: 1/2
    when:
      grid_column_preset: grid__column--custom
  
  grid_column_end_class:
    extends: auf_grid/fields/grid_column_end_class
    width: 1/2
    when:
      grid_column_preset: grid__column--custom
```

### use in your snippet

```php

use auf\Grid;

$grid = new Grid();

$columnSpan = $grid->getGridColumnSpanByStartAndEndColumnClasses('grid__column--start-1', 'grid__column--end-3');

$spanWidthInPx = $grid->getGridColumnSpanWidthInPx(3);
```

If you use grid_column_presets in your site configuration, you can pass the structure field as an argument

```php

$grid = new Grid($site->grid_column_presets()->toStructure());

$columnSpan = $grid->getGridColumnSpanByPreset('grid__column--aside');

```

### Test the grid

The plugin sets up a custom route with a virtual testpage at:

http://yourdomain.com/grid-tests


- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

## Todos

* [X] ~~*The grid.css should be created as a file for caching and not beeing-recreated for every page request. Perhaps this is a good*~~ [2020-07-12] 

* [X] ~~*Clean up test page*~~ [2020-07-12]

* [ ] Create Image test page

* [ ] Implement Inline Grid Classes

* [ ] Implement justify and align classes

* [ ] Create Nice Create-Grid-Panel-View

* [ ] grid_start/end_column_classes should be created dynamically in a custom field