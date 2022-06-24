<?php declare(strict_types=1);
namespace Rist\App\Router;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class WebRouterInvoker
{
    public function __invoke(App $app): App
    {
        $app->group('', function (RouteCollectorProxy $route) {
            require dirname(dirname(dirname(__DIR__))) . '/server/routes/web.php';
        });

        return $app;
    }
}
