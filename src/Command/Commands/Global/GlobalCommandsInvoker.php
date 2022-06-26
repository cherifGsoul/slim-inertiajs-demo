<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Global;

use Noesis\Command\Commands\AbstractCommandInvoker;
use Symfony\Component\Console\Application;

class GlobalCommandsInvoker extends AbstractCommandInvoker
{
    public function __invoke(Application $app): Application
    {
        return $this->autoload(__FILE__, __NAMESPACE__, $app);
    }
}