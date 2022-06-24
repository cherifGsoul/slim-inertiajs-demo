<?php declare(strict_types=1);
namespace App\Providers;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Cherif\InertiaPsr15\Service\InertiaFactoryInterface;
use Psr\Container\ContainerInterface;
use Noesis\ServiceProvider\ServiceProviderInterface;

class InertiaMiddlewareProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object
    {
        return new InertiaMiddleware($container->get(InertiaFactoryInterface::class));
    }
}