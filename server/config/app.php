<?php declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Level;

$root = dirname(dirname(__DIR__));

return [
    'environment' => 'dev',
    'db' => [
        'connection' => env('DB_CONNECTION', 'sqlite'),
        'database'   => $root . env('DB_DATABASE', "/db/dev.db")
    ],
    'views_directory' => "$root/server/resources/views",
    'logs' => [
        'channel'   => 'logs',
        'handler'   => StreamHandler::class,
        'path'      => "$root/server/logs/{date}_{channel}.log",
        'level'     => Level::Info
    ],
    'oauth' => [
        'github' => [
            'client_id'     => env('GITHUB_OAUTH_CLIENT_ID'),
            'client_secret' => env('GITHUB_OAUTH_SECRET'),
            'redirect_uri'  => env('GITHUB_OAUTH_REDIRECT_URI')
        ],
        'linkedin' => [
            'client_id'     => env('LINKEDIN_OAUTH_CLIENT_ID'),
            'client_secret' => env('LINKEDIN_OAUTH_SECRET'),
            'redirect_uri'  => env('LINKEDIN_OAUTH_REDIRECT_URI')
        ],
        'twitter' => [
            'consumer_key'    => env('TWITTER_OAUTH_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_OAUTH_CONSUMER_SECRET'),
            'client_id'       => env('TWITTER_OAUTH_CLIENT_ID'),
            'client_secret'   => env('TWITTER_OAUTH_CLIENT_SECRET'),
            'redirect_uri'    => env('TWITTER_OAUTH_REDIRECT_URI')
        ]
    ]
];
