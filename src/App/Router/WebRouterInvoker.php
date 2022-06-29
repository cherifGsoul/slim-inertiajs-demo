<?php declare(strict_types=1);
namespace Noesis\App\Router;

use Slim\App;
use Slim\Handlers\Strategies\RequestResponseNamedArgs;
use Slim\Routing\RouteCollectorProxy;

class WebRouterInvoker
{
    public function __invoke(App $app): App
    {
        $app->group('', function (RouteCollectorProxy $route) use ($app) {
            $routeCollector = $app->getRouteCollector();
            $routeCollector->setDefaultInvocationStrategy(new RequestResponseNamedArgs);
            require dirname(dirname(dirname(__DIR__))) . '/server/routes/web.php';
        });

        return $app;
    }
}
