<?php
declare(strict_types=1);

namespace SlimInertia\Http\Handler;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ContactHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
        return $inertia->render('Contact', []);
    }
}