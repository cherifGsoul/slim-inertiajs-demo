<?php declare(strict_types=1);

use App\Providers\ConfigProvider;
use App\Providers\InertiaFactoryInterfaceProvider;
use App\Providers\InertiaMiddlewareProvider;
use App\Providers\LoggerInterfaceProvider;
use App\Providers\ResponseProvider;
use App\Providers\RootViewProvider;
use App\Providers\ViewProvider;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Cherif\InertiaPsr15\Service\InertiaFactoryInterface;
use Cherif\InertiaPsr15\Service\RootViewProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Noesis\View\View;

return [
    'config' => ConfigProvider::class,
    InertiaFactoryInterface::class => InertiaFactoryInterfaceProvider::class,
    InertiaMiddleware::class => InertiaMiddlewareProvider::class,
    RootViewProviderInterface::class => RootViewProvider::class,
    ResponseInterface::class => ResponseProvider::class,
    View::class => ViewProvider::class,
    LoggerInterface::class => LoggerInterfaceProvider::class
];