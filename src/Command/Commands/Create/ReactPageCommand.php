<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Create;

use Noesis\Command\Formatable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReactPageCommand extends Command
{
    use Formatable;
    
    protected static $defaultName = 'create:react-page';
    protected static $defaultDescription = 'Generates boilerplate React page in client/js/Pages';

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the React Page');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $file = <<<FILE
import React from 'react';

export default function $name(props) {
    return (<div>$name Page</div>);
};
FILE;
        $root = dirname(dirname(dirname(dirname(__DIR__))));
        $file_path =  "$root/client/js/Pages/{$name}.jsx";
        if (file_exists($file_path)) {
            throw new LogicException("File $file_path already exists");
        } else {
            if (@file_put_contents($file_path, (string) $file)) {
                $this->formatter($output)->info("Successfully created a React page at $file_path");
            } else {
                throw new LogicException("Could not write contents of React page to $file_path");
            }
        }
        
        return Command::SUCCESS;
    }
}