<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Global;

use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Noesis\App\Container\ContainerInvoker;

class ServeCommand extends Command
{
    protected static $defaultName = 'serve';
    protected static $defaultDescription = 'Boot up a development server';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        passthru('php -S localhost:80 -t public');

        return Command::SUCCESS;
    }
}