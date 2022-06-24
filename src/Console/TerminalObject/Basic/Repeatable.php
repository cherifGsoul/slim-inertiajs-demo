<?php
namespace Noesis\Console\TerminalObject\Basic;

abstract class Repeatable extends BasicTerminalObject
{
    /**
     * How many times the element should be repeated
     *
     * @var integer
     */
    protected $count;

    public function __construct($count = 1)
    {
        $this->count = (int) round(max((int) $count, 1));
    }
}
