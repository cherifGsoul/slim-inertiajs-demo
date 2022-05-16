<?php
declare(strict_types=1);

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use SlimInertia\Http\Handler\ContactHandler;

return function (App $app) {
    $app->get('/', function(Request $request, Response $response) {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
        return $inertia->render('Home', []);
    });
    $app->get('/contact', ContactHandler::class);
};