<?php

@include_once __DIR__.'/vendor/autoload.php'; # all classes set in composer.json > psr-4 are loaded here!

use auf\Grid;

Kirby::plugin('auf/grid', [
    'options' => [
		'settings' => [
            'columnCount' => 12,
            'maxColumnWidthInPx' => 90,
            'columnGapInPx' => 16,
            'oneColumnToResponsiveBreakpointInPx' => 555,
            'rowGap' => '0'
        ],
    ],
    'blueprints' => [
    
        'auf_grid/grid_settings' => __DIR__ . '/blueprints/grid_settings.yml',
        'auf_grid/fields/grid_column_start_class' => __DIR__ . '/blueprints/fields/grid_column_start_class.yml',
        'auf_grid/fields/grid_column_end_class' => __DIR__ . '/blueprints/fields/grid_column_end_class.yml',
        'auf_grid/builder/tabs/grid_component_settings' => __DIR__ . '/blueprints/builder/tabs/grid_component_settings.yml',
        'auf_grid/blueprints/builder/section' => __DIR__ . '/blueprints/builder/section.yml',
    
    ],
    'snippets' => [
        'auf-grid/grid-preview' => __DIR__ . '/snippets/grid-preview.php',
        'auf-grid/styles-grid'                                 => __DIR__ . '/snippets/styles-grid.php',
        'auf-grid/styles-grid-preset'                          => __DIR__ . '/snippets/styles-grid-preset.php',
        'auf-grid/styles-grid-column-presets'                  => __DIR__ . '/snippets/styles-grid-column-presets.php',
        'auf-grid/styles-grid-column-preset'                  => __DIR__ . '/snippets/styles-grid-column-preset.php',
        'auf-grid/styles-grid-column-start-end-span-classes'   => __DIR__ . '/snippets/styles-grid-column-start-end-span-classes.php',
    ],
    'fields' => [
        'grid_column_preset' => [
            'props' => [
            ]
        ],
    ],
    'siteMethods' => [
        'getGridColumnPresets' => function () { return site()->grid_column_presets()->toStructure()->first(); }
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
                        return Grid::setSettings($settings);
                    }
                ],
            ];
        }
    ]
]);
