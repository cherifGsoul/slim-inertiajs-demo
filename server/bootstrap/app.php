<?php declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Noesis\App\Container\ContainerInvoker;
use Noesis\App\Middleware\AppMiddlewareInvoker;
use Noesis\App\Router\ApiRouterInvoker;
use Noesis\App\Router\WebRouterInvoker;
use Slim\Factory\AppFactory;

$app = AppFactory::createFromContainer((new ContainerInvoker)());
$app = (new AppMiddlewareInvoker)($app);
$app = (new ApiRouterInvoker)($app);
$app = (new WebRouterInvoker)($app);
$app->run();
