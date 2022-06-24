<?php
namespace Noesis\Console\Util;

use Noesis\Console\Util\System\SystemFactory;
use Noesis\Console\Util\System\System;

class UtilFactory
{
    /**
     * A instance of the appropriate System class
     *
     * @var \Noesis\Console\Util\System\System
     */

    public $system;

    /**
     * A instance of the Cursor class
     *
     * @var \Noesis\Console\Util\Cursor
     */
    public $cursor;

    public function __construct(System $system = null, Cursor $cursor = null)
    {
        $this->system = $system ?: SystemFactory::getInstance();
        $this->cursor = $cursor ?: new Cursor();
    }

    /**
     * Get the width of the terminal
     *
     * @return integer
     */

    public function width()
    {
        return (int) $this->getDimension($this->system->width(), 80);
    }

    /**
     * Get the height of the terminal
     *
     * @return integer
     */

    public function height()
    {
        return (int) $this->getDimension($this->system->height(), 25);
    }

    /**
     * Determine if the value is numeric, fallback to a default if not
     *
     * @param integer|null $dimension
     * @param integer $default
     *
     * @return integer
     */

    protected function getDimension($dimension, $default)
    {
        return (is_numeric($dimension)) ? $dimension : $default;
    }
}
