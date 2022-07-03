<?php declare(strict_types=1);
namespace App\Presenter;

use Noesis\Presenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;

class ContactPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
        $session = session($request);
        $user = $session->exists('user') ? $session->get('user') : [];

        return $inertia->render('Contact', ['author' => 'Luke Watts', 'user' => $user]);
    }

}
