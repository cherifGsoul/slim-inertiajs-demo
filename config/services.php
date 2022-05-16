<?php
declare(strict_types=1);

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Cherif\InertiaPsr15\Service\InertiaFactory;
use Cherif\InertiaPsr15\Service\InertiaFactoryInterface;
use Cherif\InertiaPsr15\Service\RootViewProviderDecorator;
use Cherif\InertiaPsr15\Service\RootViewProviderInterface;
use Cherif\InertiaPsr15\Twig\InertiaExtension;
use Fullpipe\TwigWebpackExtension\WebpackExtension;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\StreamFactory;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

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
        $twig = $container->get(Twig::class);
        return new RootViewProviderDecorator([$twig->getEnvironment(), 'render'], 'app.html.twig');
    },
    Twig::class => function (ContainerInterface $container) {
        $twig = Twig::create(
            dirname(__DIR__) . '/templates',
            ['cache' => false]
        );
        $twig->addExtension(new InertiaExtension());
        $twig->addExtension(
            new WebpackExtension(
                dirname(__DIR__) . '/public/build/manifest.json',
                dirname(__DIR__) . '/public/build'
            )
        );
        return $twig;
    },
];