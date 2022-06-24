<?php declare(strict_types=1);
namespace App\Providers;

use Cherif\InertiaPsr15\Service\RootViewProviderDecorator;
use Psr\Container\ContainerInterface;
use Noesis\ServiceProvider\ServiceProviderInterface;
use Noesis\View\View;

class RootViewProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): object
    {
        $view = $container->get(View::class);
        $view->setLayout('layout.php');
        return new RootViewProviderDecorator([$view, 'renderToString'], 'app.php');
    }
}