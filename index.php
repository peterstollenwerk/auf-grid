<?php

load([
    'auf\\plugin\\exampleclass' => 'classes/Exampleclass.php'
], __DIR__);

Kirby::plugin('auf/grid', [
    'fields' => [
        'grid_column' => [
            // here we could define the backend logic for our field if needed
        ],
    ],
    'api' => [
        'routes' => [
            [
                'pattern' => 'moviereviews',
                'action'  => function () {
                    $reviews = [];
                    $apikey  = 'your api key here';
                    $request = Remote::get('https://api.nytimes.com/svc/movies/v2/reviews/picks.json?api-key=' . $apikey);
                    if ($request->code() === 200) {
                        $reviews = $request->json(false)->results;
                    }
                    return $reviews;
                }
            ]
        ]
    ],
    'icons' => []
]);
