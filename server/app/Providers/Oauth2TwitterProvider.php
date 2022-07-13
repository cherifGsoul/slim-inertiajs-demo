<?php declare(strict_types=1);
namespace App\Providers;

use Noesis\ServiceProvider\ServiceProviderInterface;
use Noesis\OAuth2\Client\Provider\Twitter;
use Psr\Container\ContainerInterface;

class Oauth2TwitterProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $Container): object
    {
        $config = $Container->get('config')->oauth['twitter'];
        return new Twitter([
            'clientId'      => $config['client_id'],
            'clientSecret'  => $config['client_secret'],
            'redirectUri'   => $config['redirect_uri'],
        ]);
    }
}
