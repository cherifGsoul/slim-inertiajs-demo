<?php declare(strict_types=1);
namespace App\Presenter;

use Noesis\Presenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ContactPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $session = session($request);
        $user = $session->exists('user') ? $session->get('user') : [];
        $logged_in = false;
        if (!empty($user)) {
            $logged_in = true;
        }

        return inertia($request)->render('Contact', ['author' => 'Luke Watts', 'user' => $user, 'logged_in' => $logged_in]);
    }
}
