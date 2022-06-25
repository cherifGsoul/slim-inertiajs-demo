<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Pest;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PestInitCommand extends Command
{
    protected static $defaultName = 'pest:init';
    protected static $defaultDescription = 'Initialize all pest files. Run this to setup tests folder in a new project';

    private string $helpText = 'Initialize all pest files. Run this to setup tests folder in a new project

Pest docs: https://pestphp.com/docs/installation#installation';

    protected function configure(): void
    {
        $this->setHelp($this->helpText);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path_to_pest = dirname(dirname(dirname(dirname(__DIR__)))) . '/vendor/bin/pest';
        $command =  '--init';
        
        if (!file_exists($path_to_pest)) {
            $error = 'Pest not found. Please ensure it is installed and the file /vendor/bin/pest exists';
            throw new LogicException($error);
        }

        passthru("$path_to_pest $command");
        
        return Command::SUCCESS;
    }
}