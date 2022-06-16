<?php declare(strict_types=1);
namespace Rist\Presenter;

use Psr\Container\ContainerInterface;

class Presenter
{
    /**
     * Container
     *
     * @var ContainerInterface
     */
    private ContainerInterface $Container;

    /**
     * __construct
     *
     * @param ContainerInterface $Container
     */
    public function __construct(ContainerInterface $Container)
    {
        $this->Container = $Container;
    }
    
}