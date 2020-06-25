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
    'fields' => [
        'grid_column' => [
            'props' => [
                'test' => 'TEST'
            ]
        ],
    ],
    'icons' => [],
    'api' => [
        'routes' => [
            [
                'pattern' => 'grid/settings',
                'action'  => function () {
                    return option('auf.grid.settings');
                }
            ],
            [
                'pattern' => 'grid/set-settings',
                'action'  => function () {
                    return '123';
                }
            ]
        ]
    ]
]);
