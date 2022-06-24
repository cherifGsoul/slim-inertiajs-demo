<?php declare(strict_types=1);
namespace App\Providers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Rist\ServiceProvider\ServiceProviderInterface;
use Rist\View\View;

class ViewProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object
    {
        $view = new View($container->get(ResponseInterface::class), $container->get('config')->views_directory);

        return $view;
    }
}