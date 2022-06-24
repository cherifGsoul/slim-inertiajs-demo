<?php declare(strict_types=1);
namespace Noesis\App\ServiceProvider;

use Psr\Container\ContainerInterface;

class ServiceProvidersInvoker
{
    public function __invoke(): array
    {
        $providers = require dirname(dirname(dirname(__DIR__))) . '/server/config/providers.php';

        $service_providers = [];
        foreach($providers as $fully_qualified_name => $service_provider) {        
            $service_providers[$fully_qualified_name] = function(ContainerInterface $Container) use ($service_provider) {
                $Invoke = new $service_provider;
                return $Invoke($Container);
            };
        }

        return $service_providers;
    }
}
