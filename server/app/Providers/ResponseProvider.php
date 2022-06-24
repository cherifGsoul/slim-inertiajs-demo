<?php declare(strict_types=1);

namespace App\Providers;

use Psr\Container\ContainerInterface;
use Rist\ServiceProvider\ServiceProviderInterface;

class ResponseProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container):object
    {
        return new \Laminas\Diactoros\Response;
    }
}