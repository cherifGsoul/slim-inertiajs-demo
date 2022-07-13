<?php declare(strict_types=1);
namespace Noesis\Auth\Presenter\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Psr\Http\Message\ServerRequestInterface;
use Noesis\OAuth2\Client\Provider\Twitter;
use Psr\Http\Message\ResponseInterface;
use Noesis\Presenter;

class LoginPresenter extends Presenter\Presenter implements Presenter\PresenterInterface
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $config = $this->container->get('config')->oauth['twitter'];
        $twitteroauth = new TwitterOAuth($config['consumer_key'], $config['consumer_secret']);
        $request_token = $twitteroauth->oauth(
            'oauth/request_token', [
                'oauth_callback' => $config['redirect_uri']
            ]
        );

        // throw exception if something gone wrong
        if ($twitteroauth->getLastHttpCode() != 200) {
            throw new \Exception('There was a problem connecting to the Twitter API');
        }

        // save token of application to session
        session($request)->set('oauth_token', $request_token['oauth_token']);
        session($request)->set('oauth_token_secret', $request_token['oauth_token_secret']);
        
        $authUrl = $twitteroauth->url(
            'oauth/authorize', [
                'oauth_token' => $request_token['oauth_token']
            ]
        );

        return $response->withHeader('Location', $authUrl)->withStatus(302);
    }
}
