<?php

@include_once __DIR__.'/vendor/autoload.php';

// load([
//     'auf\\gridColumnPreset' => 'lib/gridColumPreset.php',
//     'auf\\grid' => 'lib/grid.php'
// ], __DIR__);

Kirby::plugin('auf/grid', [
    'options' => [
		'settings' => [
            'columnCount' => 12,
            'columnWidth' => 90
        ],
    ],
    'fields' => [
        'grid_column' => [
            'props' => [
                'test' => 'TEST'
            ]
            // here we could define the backend logic for our field if needed
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
            ]
        ]
    ]
]);
