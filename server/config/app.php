<?php declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Level;

return [
    'environment' => 'dev',
    'views_directory' => dirname(dirname(__DIR__)) . '/server/resources/views',
    'logs' => [
        'channel'   => 'logs',
        'handler'   => StreamHandler::class,
        'path'      => dirname(dirname(__DIR__)) . '/server/logs/{date}_{channel}.log',
        'level'     => Level::Info
    ],
    'oauth' => [
        'github' => [
            'client_id'     => env('GITHUB_OAUTH_CLIENT_ID'),
            'client_secret' => env('GITHUB_OAUTH_SECRET'),
            'redirect_uri'  => env('GITHUB_OAUTH_REDIRECT_URI')
        ]
        
    ]
];
