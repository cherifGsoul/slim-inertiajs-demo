<?php declare(strict_types=1);
namespace Noesis\Auth\Presenter\Linkedin;

use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Client\Provider\LinkedIn;
use Noesis\Auth\Adapter\LinkedinAuthentication;
use Psr\Http\Message\ResponseInterface;
use Noesis\Presenter;
use Noesis\Support\UserFactory;

class CallbackPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $provider = $this->container->get(LinkedIn::class);
        $query_params = $request->getQueryParams();

        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $query_params['code']
        ]);

        // Now we have a token you can look up a users profile data
        try {
            // We got an access token, let's now get the user's details
            $resource_owner = $provider->getResourceOwner($token);
            $user = UserFactory::fromOauthResourceOwner($resource_owner, 'linkedin');
            if (LinkedinAuthentication::validate($user['email'])->isValid()) {
                session($request)->set('user', $user);
            }            
        } catch (\Exception $e) {
            // Failed to get user details
            throw new \Exception("Could not retreive user details from Github. {$e->getMessage()}");
        }

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}