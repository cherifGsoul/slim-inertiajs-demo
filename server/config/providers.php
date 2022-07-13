<?php declare(strict_types=1);

use Cherif\InertiaPsr15\Service\RootViewProviderInterface;
use Cherif\InertiaPsr15\Service\InertiaFactoryInterface;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use App\Providers\InertiaFactoryInterfaceProvider;
use App\Providers\InertiaMiddlewareProvider;
use League\OAuth2\Client\Provider\LinkedIn;
use App\Providers\LoggerInterfaceProvider;
use Noesis\OAuth2\Client\Provider\Twitter;
use League\OAuth2\Client\Provider\Github;
use App\Providers\Oauth2LinkedinProvider;
use App\Providers\Oauth2TwitterProvider;
use App\Providers\Oauth2GithubProvider;
use Psr\Http\Message\ResponseInterface;
use App\Providers\ResponseProvider;
use App\Providers\RootViewProvider;
use App\Providers\SessionProvider;
use App\Providers\ConfigProvider;
use App\Providers\ViewProvider;
use Psr\Log\LoggerInterface;
use Noesis\View\View;

return [
    InertiaFactoryInterface::class => InertiaFactoryInterfaceProvider::class,
    InertiaMiddleware::class => InertiaMiddlewareProvider::class,
    RootViewProviderInterface::class => RootViewProvider::class,
    LoggerInterface::class => LoggerInterfaceProvider::class,
    ResponseInterface::class => ResponseProvider::class,
    SessionProvider::class => SessionProvider::class,
    LinkedIn::class => Oauth2LinkedinProvider::class,
    Twitter::class => Oauth2TwitterProvider::class,
    Github::class => Oauth2GithubProvider::class,
    View::class => ViewProvider::class,
    'config' => ConfigProvider::class,
];