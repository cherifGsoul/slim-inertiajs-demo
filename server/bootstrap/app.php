<?php declare(strict_types=1);
$root = dirname(dirname(__DIR__));
require_once $root . '/vendor/autoload.php';

use Noesis\App\Middleware\AppMiddlewareInvoker;
use Noesis\App\Container\ContainerInvoker;
use Noesis\App\Router\ApiRouterInvoker;
use Noesis\App\Router\WebRouterInvoker;
use Noesis\App\AppFactory;
use Dotenv\Dotenv;

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "sqlite",
    "host" =>"127.0.0.1",
    "database" => dirname(__DIR__, 2) . '/db/noesis.db',
    "username" => "root",
    "password" => ""
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$dotenv = Dotenv::createImmutable($root);
$dotenv->load();

// Eloquent

$app = AppFactory::createFromContainer((new ContainerInvoker)());
$app = (new AppMiddlewareInvoker)($app);
$app = (new ApiRouterInvoker)($app);
$app = (new WebRouterInvoker)($app);

return $app;
