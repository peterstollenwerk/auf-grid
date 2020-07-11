# auf-grid

## Installation

### CSS Setup

Include the generated grid styles in the head of your document:

```php
<style>
  <?= snippet('auf-grid/styles-grid'); ?>
</style>
```

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

## Todos

* [ ] The grid.css should be created as a file for caching and not beeing-recreated for every page request. Perhaps this is a good 