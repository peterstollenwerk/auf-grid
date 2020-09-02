<?php

@include_once __DIR__.'/vendor/autoload.php'; # all classes set in composer.json > psr-4 are loaded here!

use auf\Grid;
use Kirby\Cms\Page;

Kirby::plugin('auf/grid', [
    'options' => [
        'settings' => [
            'columnCount' => 12,
            'maxColumnWidthInPx' => 80,
            'columnGapInPx' => 26,
            'oneColumnToResponsiveBreakpointInPx' => 600,
            'rowGap' => '0',
        ],
    ],
    'blueprints' => [
        'auf_grid/grid_settings' => __DIR__ . '/blueprints/grid_settings.yml',
    ],
    'snippets' => [
        'auf-grid/grid-preview' => __DIR__ . '/snippets/grid-preview.php',
        'auf-grid/grid-overlay' => __DIR__ . '/snippets/grid-overlay.php',
    ],
    'fields' => [
        'grid_column_preset' => [
            'props' => []
        ],
        'grid_column_start_class' => [
            'props' => [
                'classes' => function() {
                    $grid = new Grid();
                    return $grid->gridColumnStartClasses();
                }
            ]
        ],
        'grid_column_end_class' => [
            'props' => [
                'classes' => function() {
                    $grid = new Grid();
                    return $grid->gridColumnEndClasses();
                }
            ]
        ],
        'grid_align_self' => [],
        'grid_justify_self' => [],
        'inline_grid_items_span_classes' => [
            'props' => [
                'classes' => function() {
                    $grid = new Grid();
                    return $grid->inlineGridItemsSpanClasses();
                }
            ]
        ],
        'grid_align_items' => [],
        'grid_justify_items' => [],
        'grid_settings' => [
            'props' => [
                'start_classes' => function() {
                    $grid = new Grid();
                    return $grid->gridColumnStartClasses();
                },
                'end_classes' => function() {
                    $grid = new Grid();
                    return $grid->gridColumnEndClasses();
                }
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
                        $grid = new Grid();
                        return (array)$grid;
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
