<?php declare(strict_types=1);
namespace App\Providers;

use Noesis\ServiceProvider\ServiceProviderInterface;
use League\OAuth2\Client\Provider\LinkedIn;
use Psr\Container\ContainerInterface;

class Oauth2LinkedinProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $Container): object
    {
        $config = $Container->get('config')->oauth['linkedin'];
        return new LinkedIn([
            'clientId'      => $config['client_id'],
            'clientSecret'  => $config['client_secret'],
            'redirectUri'   => $config['redirect_uri'],
        ]);
    }
}
