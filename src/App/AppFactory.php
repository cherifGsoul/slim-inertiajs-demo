<?php declare(strict_types=1);
namespace Noesis\App;

use Slim\Factory\AppFactory as SlimAppFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\MiddlewareDispatcherInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteResolverInterface;

class AppFactory extends SlimAppFactory
{
    /**
     * @param ContainerInterface $container
     * @return App
     */
    public static function createFromContainer(ContainerInterface $container): App
    {
        $responseFactory = $container->has(ResponseFactoryInterface::class)
        && (
            $responseFactoryFromContainer = $container->get(ResponseFactoryInterface::class)
        ) instanceof ResponseFactoryInterface
            ? $responseFactoryFromContainer
            : self::determineResponseFactory();

        $callableResolver = $container->has(CallableResolverInterface::class)
        && (
            $callableResolverFromContainer = $container->get(CallableResolverInterface::class)
        ) instanceof CallableResolverInterface
            ? $callableResolverFromContainer
            : null;

        $routeCollector = $container->has(RouteCollectorInterface::class)
        && (
            $routeCollectorFromContainer = $container->get(RouteCollectorInterface::class)
        ) instanceof RouteCollectorInterface
            ? $routeCollectorFromContainer
            : null;

        $routeResolver = $container->has(RouteResolverInterface::class)
        && (
            $routeResolverFromContainer = $container->get(RouteResolverInterface::class)
        ) instanceof RouteResolverInterface
            ? $routeResolverFromContainer
            : null;

        $middlewareDispatcher = $container->has(MiddlewareDispatcherInterface::class)
        && (
            $middlewareDispatcherFromContainer = $container->get(MiddlewareDispatcherInterface::class)
        ) instanceof MiddlewareDispatcherInterface
            ? $middlewareDispatcherFromContainer
            : null;

        return new App(
            $responseFactory,
            $container,
            $callableResolver,
            $routeCollector,
            $routeResolver,
            $middlewareDispatcher
        );
    }
}