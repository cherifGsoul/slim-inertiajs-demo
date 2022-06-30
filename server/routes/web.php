<?php declare(strict_types=1);

use Noesis\View\View;
use App\Presenter\HomePresenter;
use App\Presenter\ContactPresenter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$route->get('/', HomePresenter::class);
$route->get('/contact', ContactPresenter::class);
$route->get('/non-inertia-view', function(Request $request, Response $response) {
    $view = $this->get(View::class);
    $view->setLayout('layout.php');

    return $view->render($response, 'non-inertia-view.php', ['author' => 'Luke Watts']);
});