<?php

use Recruitment\Actions as RouteActions;

return [
    'actions' => [
        '\\Recruitment\\Actions'
    ],
    'routes' => [
        '/' => \Recruitment\Actions\Index::class
    ]
];