<?php declare(strict_types=1);
namespace App\Presenter;

use Noesis\Presenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;

class HomePresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

        $session = session($request);
        $user = ($session->exists('user')) ? $session->get('user') : [];
        $logged_in = false;
        $message = 'Hello from Inertia Response!';
        if (!empty($user)) {
            $logged_in = true;
            if (array_key_exists('username', $user)) {
                $message = "Hello {$user['username']}!";
            }
        }
        
        return $inertia->render('Home', [
            'logged_in' => $logged_in, 
            'user' => $user,
            'message' => $message
        ]);
    }
}
