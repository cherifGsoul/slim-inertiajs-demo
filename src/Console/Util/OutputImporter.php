<?php
namespace Noesis\Console\Util;

trait OutputImporter
{
    /**
     * An instance of the OutputFactory
     *
     * @var \Noesis\Console\Util\Output $output
     */
    protected $output;

    /**
     * Sets the $output property
     *
     * @param Output $output
     */
    public function output(Output $output)
    {
        $this->output = $output;
    }
}
