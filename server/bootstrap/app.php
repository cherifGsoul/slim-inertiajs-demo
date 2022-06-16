<?php declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;

try {
    $config = require dirname(__DIR__) . '/config/app.php';
    $providers = require dirname(__DIR__) . '/config/providers.php';

    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions($providers);
    $container = $containerBuilder->build();
    $app = AppFactory::createFromContainer($container);
    $app->add(new WhoopsMiddleware([
        'enable' => ($config['environment'] !== 'prod' && $config['environment'] !== 'production') ? true : false,
        'editor' => 'vscode'
    ]));


    $routeCollector = $app->getRouteCollector();
    $routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());

    (require dirname(__DIR__) . '/config/middlewares.php')($app);

    $app->group('/api', function(RouteCollectorProxy $route) {
        require dirname(__DIR__) . '/routes/api.php';
    });
    
    $app->group('', function (RouteCollectorProxy $route) {
        require dirname(__DIR__) . '/routes/web.php';
    });

    $app->run();
} catch (\Exception $e) {
    echo '<pre>', $e->getMessage(), '<br>', $e->getTraceAsString(), '</pre>';
}