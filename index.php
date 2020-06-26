<?php

@include_once __DIR__.'/vendor/autoload.php'; # all classes set in composer.json > psr-4 are loaded here!

use auf\Grid;

Kirby::plugin('auf/grid', [
    'options' => [
		'settings' => [
            'columnCount' => 12,
            'maxColumnWidthInPx' => 90,
            'columnGapInPx' => 16,
            'oneColumnToResponsiveBreakpointInPx' => 600
        ],
    ],
    'blueprints' => [
    
        'auf_grid/grid_settings' => __DIR__ . '/blueprints/grid_settings.yml',
        'auf_grid/fields/grid_column_start_class' => __DIR__ . '/blueprints/fields/grid_column_start_class.yml',
        'auf_grid/fields/grid_column_end_class' => __DIR__ . '/blueprints/fields/grid_column_end_class.yml',
        'auf_grid/fields/grid_column_preset' => __DIR__ . '/blueprints/fields/grid_column_preset.yml',
        'auf_grid/builder/tabs/grid_component_settings' => __DIR__ . '/blueprints/builder/tabs/grid_component_settings.yml',
        'auf_grid/blueprints/builder/section' => __DIR__ . '/blueprints/builder/section.yml',
    
    ],
    'fields' => [
        'grid_column' => [
            'props' => [
                'test' => 'TEST'
            ]
        ],
    ],
    'icons' => [],
    'api' => [
        'routes' => function ($kirby) {
            return [
                [
                    'pattern' => 'grid/settings',
                    'method' => 'GET',
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
                ]
            ];
        }
    ]
]);
