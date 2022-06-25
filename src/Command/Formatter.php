<?php declare(strict_types=1);
namespace Noesis\Command;

use Symfony\Component\Console\Output\OutputInterface;

trait Formatter
{
    public function info($message, $writeln = true): void
    {
        if (!$writeln) {
            $this->output->write("<info>$message</info>");
        }

        $this->output->writeln("<info>$message</info>");
    }

    public function formatter(OutputInterface $output)
    {
        $this->output = $output;

        return $this;
    }
}