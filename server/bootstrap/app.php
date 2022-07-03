<?php declare(strict_types=1);
$root = dirname(dirname(__DIR__));
require_once $root . '/vendor/autoload.php';

use Noesis\App\Middleware\AppMiddlewareInvoker;
use Noesis\App\Container\ContainerInvoker;
use Noesis\App\Router\ApiRouterInvoker;
use Noesis\App\Router\WebRouterInvoker;
use Noesis\App\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

$app = AppFactory::createFromContainer((new ContainerInvoker)());
$app = (new AppMiddlewareInvoker)($app);
$app = (new ApiRouterInvoker)($app);
$app = (new WebRouterInvoker)($app);

return $app;
