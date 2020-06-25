<?php

@include_once __DIR__.'/vendor/autoload.php'; # all classes set in composer.json > psr-4 are loaded here!

use auf\Grid;
use Kirby\Data\Json;
use PHPUnit\Util\Json as UtilJson;

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
