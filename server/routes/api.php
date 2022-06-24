<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;

// Define API routes here. They will automatically be prefixed with /api
$route->get('/user', function() {
    $response = new JsonResponse(['name' => 'Luke Watts']);
    return $response;
});