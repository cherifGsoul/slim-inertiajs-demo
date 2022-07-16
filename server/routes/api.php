<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;
use Slim\Routing\RouteCollectorProxy;

// Define API routes here. They will automatically be prefixed with /api
/** @var RouteCollectorProxy $route */
$route->get('/user', function() {
    return new JsonResponse(['name' => 'Luke Watts']);
});