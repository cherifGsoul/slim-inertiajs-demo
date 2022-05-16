<?php
declare(strict_types=1);

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $app->addMiddleware($container->get(InertiaMiddleware::class));
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(
        true,
        true,
        true
    );
};
