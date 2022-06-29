<?php declare(strict_types=1);
namespace Noesis\App\Router;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Handlers\Strategies\RequestResponseNamedArgs;

class ApiRouterInvoker
{
    public function __invoke(App $app): App
    {
        $app->group('', function (RouteCollectorProxy $route) use ($app) {
            $routeCollector = $app->getRouteCollector();
            $routeCollector->setDefaultInvocationStrategy(new RequestResponseNamedArgs);
            require dirname(dirname(dirname(__DIR__))) . '/server/routes/api.php';
        });

        return $app;
    }
}
