<?php declare(strict_types=1);
namespace Noesis\Presenter;

use Noesis\Presenter\PresenterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Presenter implements PresenterInterface
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    abstract public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}