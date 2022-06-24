<?php declare(strict_types=1);
namespace Rist\App\Container;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Rist\App\ServiceProvider\ServiceProvidersInvoker;

class ContainerInvoker
{
    public function __invoke(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions((new ServiceProvidersInvoker)());
        
        return $containerBuilder->build();
    }
}
