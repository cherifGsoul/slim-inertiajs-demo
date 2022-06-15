<?php declare(strict_types=1);

use App\Http\Controller\PagesController;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimInertia\View\View;

$route->get('/', [PagesController::class, 'home']);

$route->get('/contact', [PagesController::class, 'contact']);

$route->get('/non-inertia-view', function(RequestInterface $request, Response $response)  {
    $view = $this->get(View::class);
    $view->setLayout('layout.php');
    return $view->render($response, 'non-inertia-view.php', ['author' => 'Luke Watts']);
});