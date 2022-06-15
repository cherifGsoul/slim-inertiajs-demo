<?php declare(strict_types=1);

use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\RequestInterface;

// Define API routes here. They will automatically be prefixed with /api
$route->get('/user', function(RequestInterface $request) {
    $response = new JsonResponse(['name' => 'Luke Watts']);
    return $response;
});