<?php declare(strict_types=1);
namespace Noesis\Auth\Presenter\Linkedin;

use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Client\Provider\LinkedIn;
use Psr\Http\Message\ResponseInterface;
use Noesis\Presenter;

class LoginPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $config = $this->container->get('config')->oauth['linkedin'];
        $provider = new LinkedIn([
            'clientId'      => $config['client_id'],
            'clientSecret'  => $config['client_secret'],
            'redirectUri'   => $config['redirect_uri'],
        ]);

        $authUrl = $provider->getAuthorizationUrl();
        session($request)->set('oauth2state', $provider->getState());

        return $response->withHeader('Location', $authUrl)->withStatus(302);
    }

}
