<?php declare(strict_types=1);
namespace Rist\ServiceProvider;

use Psr\Container\ContainerInterface;

interface ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object;
}