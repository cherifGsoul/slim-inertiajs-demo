<?php declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Noesis\Auth\Route\OAuthRoutesInvoker;
use App\Presenter\ContactPresenter;
use App\Presenter\HomePresenter;
use Noesis\View\View;

/** @var \Slim\Routing\RouteCollectorProxy $route */
$route->get('/', HomePresenter::class);
$route->get('/contact', ContactPresenter::class);
$route->get('/non-inertia-view', function(Request $request, Response $response) {
    $view = $this->get(View::class);
    $view->setLayout('layout.php');

    return $view->render($response, 'non-inertia-view.php', ['author' => 'Luke Watts']);
});

$route = (new OAuthRoutesInvoker)($route, [
    'github',
    'linkedin',
    'twitter'
]);
