<?php declare(strict_types=1);

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Cherif\InertiaPsr15\Service\InertiaFactory;
use Cherif\InertiaPsr15\Service\InertiaFactoryInterface;
use Cherif\InertiaPsr15\Service\RootViewProviderDecorator;
use Cherif\InertiaPsr15\Service\RootViewProviderInterface;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\StreamFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use SlimInertia\View\View;

return [
    InertiaMiddleware::class => function (ContainerInterface $container) {
        return new InertiaMiddleware($container->get(InertiaFactoryInterface::class));
    },
    InertiaFactoryInterface::class => function(ContainerInterface $container) {
        return new InertiaFactory(
            new ResponseFactory(),
            new StreamFactory(),
            $container->get(RootViewProviderInterface::class)
        );
    },
    RootViewProviderInterface::class => function(ContainerInterface $container) {
        $view = $container->get(View::class);
        $view->setLayout('layout.php');
        return new RootViewProviderDecorator([$view, 'renderToString'], 'app.php');
    },
    ResponseInterface::class => function(ContainerInterface $container) {
        return new \Laminas\Diactoros\Response;
    },
    View::class => function (ContainerInterface $container) use ($config) {
        $view = new View($container->get(ResponseInterface::class), $config['views_directory']);

        return $view;
    }
];