<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Global;

use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Noesis\App\Container\ContainerInvoker;

class InspectCommand extends Command
{
    protected static $defaultName = 'inspect';
    protected static $defaultDescription = 'REPL for inspecting and debugging Noesis code directly in the terminal during development';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sh = new Shell;

        $container = (new ContainerInvoker)();
        
        $root = dirname(dirname(dirname(dirname(__DIR__))));
        $app = require_once "$root/server/bootstrap/app.php";
        $sh->setScopeVariables(compact('container', 'app'));
        $sh->run();

        return Command::SUCCESS;
    }
}