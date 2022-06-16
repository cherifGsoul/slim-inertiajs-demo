<?php
namespace Rist\Console\TerminalObject\Helper;

interface SleeperInterface
{
    /**
     * @param int|float $percentage
     */
    public function speed($percentage);

    public function sleep();
}
