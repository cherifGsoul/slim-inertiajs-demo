<?php declare(strict_types=1);
namespace App\Presenter;

use Rist\Presenter\PresenterInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;

class HomePresenter implements PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

        return $inertia->render('Home', [
            'message' => 'Hello from Inertia Response!'
        ]);
    }

}
