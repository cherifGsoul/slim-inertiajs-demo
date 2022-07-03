<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Global;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command
{
    protected static $defaultName = 'add';
    protected static $defaultDescription = 'Install a composer package';

    protected function configure(): void
    {
        $this
            ->addArgument('package_name', InputArgument::REQUIRED, 'The name of the composer package to install (e.g. affinity4/validate)')
            ->addOption('dev', 'd');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $package_name = $input->getArgument('package_name');
        $command = ($input->getOption('dev')) ? "composer require --dev $package_name" : "composer require $package_name";
        passthru($command);

        return Command::SUCCESS;
    }
}