<?php declare(strict_types=1);
namespace Noesis\Auth\Presenter\Twitter;

use Noesis\OAuth2\Client\Provider\TwitterResourceOwner;
use Noesis\Auth\Adapter\TwitterAuthentication;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Abraham\TwitterOAuth\TwitterOAuth;
use Noesis\Support\UserFactory;
use Noesis\Presenter;

class CallbackPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $config = $this->container->get('config')->oauth['twitter'];
        $query_params = $request->getQueryParams();

        // Now we have a token you can look up a users profile data
        try {
            $oauth_verifier = $query_params['oauth_verifier'];
            // connect with application token
            $connection = new TwitterOAuth(
                $config['consumer_key'],
                $config['consumer_secret'],
                session($request)->get('oauth_token'),
                session($request)->get('oauth_token_secret')
            );
            
            // request user token
            $token = $connection->oauth(
                'oauth/access_token', [
                    'oauth_verifier' => $oauth_verifier
                ]
            );

            $provider = new TwitterOAuth(
                $config['consumer_key'],
                $config['consumer_secret'],
                $token['oauth_token'],
                $token['oauth_token_secret']
            );
            $provider->setApiVersion('2');

            $user_id = explode('-', $token['oauth_token'])[0];
            $user_data = $provider->get('users', ['ids' => $user_id]);
            $resource_owner = new TwitterResourceOwner($user_data);

            $user = UserFactory::fromOauthResourceOwner($resource_owner, 'twitter');
            $isUserValid = TwitterAuthentication::validate($user['username'])->isValid();
            if ($isUserValid) {
                session($request)->set('user', $user);
            }
        } catch (\Exception $e) {
            // Failed to get user details
            throw new \Exception("Could not retreive user details from Twitter. {$e->getMessage()}");
        }

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}