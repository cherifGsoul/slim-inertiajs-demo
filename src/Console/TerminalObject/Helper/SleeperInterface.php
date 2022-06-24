<?php
namespace Noesis\Console\TerminalObject\Helper;

interface SleeperInterface
{
    /**
     * @param int|float $percentage
     */
    public function speed($percentage);

    public function sleep();
}
