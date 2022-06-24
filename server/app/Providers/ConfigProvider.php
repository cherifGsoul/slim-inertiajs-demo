<?php declare(strict_types=1);
namespace App\Providers;

use Psr\Container\ContainerInterface;
use Rist\ServiceProvider\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object
    {
        return (object) require_once dirname(dirname(__DIR__)) . '/config/app.php';
    }
}