<?php declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Rist\App\Container\ContainerInvoker;
use Rist\App\Middleware\AppMiddlewareInvoker;
use Rist\App\Router\ApiRouterInvoker;
use Rist\App\Router\WebRouterInvoker;
use Slim\Factory\AppFactory;

$app = AppFactory::createFromContainer((new ContainerInvoker)());
$app = (new AppMiddlewareInvoker)($app);
$app = (new ApiRouterInvoker)($app);
$app = (new WebRouterInvoker)($app);
$app->run();
