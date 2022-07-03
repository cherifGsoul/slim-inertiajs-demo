<?php declare(strict_types=1);
namespace Noesis\Auth\Route;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;

class OAuthRoutesInvoker
{
    public function __invoke(RouteCollectorProxy $route, $providers = []): RouteCollectorProxy
    {
        $route->get('/logout', function (Request $request, Response $response) {
            session($request)->delete('user');

            return $response->withHeader('Location', '/')->withStatus(302);
        });

        collect($providers)->each(function ($provider) use (&$route) {
            $provider_name_words = explode('_', $provider);
            $ucfirst_provider_name_words = collect($provider_name_words)->map(function($word) {
                return ucfirst($word);
            });
            $class_name = implode($ucfirst_provider_name_words->toArray());
            $route->get("/login/$provider", "\\Noesis\\Auth\\Presenter\\$class_name\\LoginPresenter");
            $route->get("/auth/$provider/callback", "\\Noesis\\Auth\\Presenter\\$class_name\\CallbackPresenter");
        });

        return $route;
    }
}