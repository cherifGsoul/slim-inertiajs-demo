<?php declare(strict_types=1);
namespace App\Providers;

use Psr\Container\ContainerInterface;
use Noesis\ServiceProvider\ServiceProviderInterface;
use SlimSession\Helper;

class SessionProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $Container): object
    {
        return new Helper();
    }
}
