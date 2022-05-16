<?php


declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\App;
use Slim\Factory\AppFactory;

$services = require dirname(__DIR__) . '/config/services.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($services);
$container = $containerBuilder->build();
$app = AppFactory::createFromContainer($container);

(require dirname(__DIR__) . '/config/middlewares.php')($app);

(require dirname(__DIR__) . '/config/routes.php')($app);

$app->run();