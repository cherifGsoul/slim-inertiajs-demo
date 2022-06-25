<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Pest;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PestCommand extends Command
{
    protected static $defaultName = 'pest';
    protected static $defaultDescription = 'Run all Pest tests';

    private string $helpText = 'Run all Pest tests

Pest docs: https://pestphp.com/docs/';

    protected function configure(): void
    {
        $this->setHelp($this->helpText);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path_to_pest = dirname(dirname(dirname(dirname(__DIR__))) ). '/vendor/bin/pest';
        
        if (!file_exists($path_to_pest)) {
            $error = 'Pest not found. Please ensure it is installed and the file /vendor/bin/pest exists';
            throw new LogicException($error);
        }

        passthru($path_to_pest);
        
        return Command::SUCCESS;
    }
}