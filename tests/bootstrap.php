<?php

require_once __DIR__ . '/../kirby/bootstrap.php';

# Set Roots here:
# https://getkirby.com/docs/reference/system/roots/

new Kirby([
  'roots' => [
    'content' => __DIR__ . '/../content',
    'blueprints' => __DIR__ . '/../site/blueprints'
  ]
]);