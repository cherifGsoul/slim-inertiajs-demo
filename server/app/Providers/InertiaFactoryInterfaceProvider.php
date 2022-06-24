<?php declare(strict_types=1);
namespace App\Providers;

use Cherif\InertiaPsr15\Service\RootViewProviderInterface;
use Rist\ServiceProvider\ServiceProviderInterface;
use Cherif\InertiaPsr15\Service\InertiaFactory;
use Laminas\Diactoros\ResponseFactory;
use Psr\Container\ContainerInterface;
use Laminas\Diactoros\StreamFactory;

class InertiaFactoryInterfaceProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object
    {
        return new InertiaFactory(
            new ResponseFactory(),
            new StreamFactory(),
            $container->get(RootViewProviderInterface::class)
        );
    }
}
