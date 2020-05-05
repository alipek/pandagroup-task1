<?php
return [
    \Recruitment\Http\Router::class => [
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php'
    ],
    \Recruitment\Rendering\Templating::class => [
        [
            'template_paths' => [
                realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views'),
            ],
            'base_layout' => 'layout.php',
        ]
    ],
    \Recruitment\Dbal\Connection::class => [
        'mysql:host=127.0.0.1;dbname=panda;password=panda;charset=utf8;user=panda',
    ],
    \Recruitment\Http\Router\Firewall::class => [
        [
            'firewalls' => [
                ['pattern' => '~(/news/.*|/logout|/)$~', 'auth' => true,],
                ['pattern' => '~^/(login|register|)$~', 'auth' => false,],
            ]
        ],
    ],
];