# auf-grid

## Installation

Include the generated grid styles in the head of your document:

```php
<style>
  <?= snippet('auf-grid/styles-grid'); ?>
</style>
```

If you want to create custom column presets you can do so.
Implement our grid_settings section somewhere in your site.yml:

```site.yml
title: Site

tabs:
  settings:
    sections:
      grid_settings: auf_grid/grid_settings
```