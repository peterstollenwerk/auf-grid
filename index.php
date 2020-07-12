<?php

@include_once __DIR__.'/vendor/autoload.php'; # all classes set in composer.json > psr-4 are loaded here!

use auf\Grid;
use Kirby\Cms\Page;

Kirby::plugin('auf/grid', [
    'options' => [
        'settings' => [
            'columnCount' => 12,
            'maxColumnWidthInPx' => 90,
            'columnGapInPx' => 16,
            'oneColumnToResponsiveBreakpointInPx' => 600,
            'rowGap' => '0'
        ],
    ],
    'blueprints' => [
        'auf_grid/grid_settings' => __DIR__ . '/blueprints/grid_settings.yml',
        'auf_grid/fields/grid_column_start_class' => __DIR__ . '/blueprints/fields/grid_column_start_class.yml',
        'auf_grid/fields/grid_column_end_class' => __DIR__ . '/blueprints/fields/grid_column_end_class.yml',
        'auf_grid/fieldgroup/grid_component_settings' => __DIR__ . '/blueprints/fieldgroup/grid_component_settings.yml'
    ],
    'snippets' => [
        'auf-grid/grid-preview' => __DIR__ . '/snippets/grid-preview.php',
    ],
    'fields' => [
        'grid_column_preset' => [
            'props' => [
            ]
        ],
    ],
    'siteMethods' => [
        'getGridColumnPresets' => function () { return site()->grid_column_presets(); }
    ],
    'icons' => [],
    'api' => [
        'routes' => function ($kirby) {
            return [
                [
                    'pattern' => 'grid/settings',
                    'action'  => function () {
                        return Grid::getSettings();
                    }
                ],
                [
                    'pattern' => 'grid/settings',
                    'method' => 'POST',
                    'action'  => function () {
                        $settings = $this->requestBody('settings');
                        Grid::setSettings($settings);
                        $gridColumnPresets = $this->site()->grid_column_presets()->toStructure();
                        Grid::writeCssFile($gridColumnPresets);
                        return $settings;
                    }
                ],
            ];
        }
    ],
    'templates' => [
        'grid-tests' => __DIR__ . '/templates/grid-tests.php',
    ],
    'routes' => [
        [
          'pattern' => 'grid-tests',
          'action'  => function () {
                return Page::factory([
                    'slug' => 'grid-tests',
                    'template' => 'grid-tests',
                    'model' => 'grid-tests',
                    'content' => [
                        'title' => 'Grid Tests',
                    ]
                ]);
          }
        ]
    ]
]);
