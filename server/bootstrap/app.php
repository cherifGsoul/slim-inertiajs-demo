<?php declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Noesis\App\Middleware\AppMiddlewareInvoker;
use Noesis\App\Container\ContainerInvoker;
use Noesis\App\Router\ApiRouterInvoker;
use Noesis\App\Router\WebRouterInvoker;
use Noesis\App\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$app = AppFactory::createFromContainer((new ContainerInvoker)());
$app = (new AppMiddlewareInvoker)($app);
$app = (new ApiRouterInvoker)($app);
$app = (new WebRouterInvoker)($app);

return $app;
