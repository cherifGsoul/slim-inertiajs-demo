<?php
namespace Noesis\Console\TerminalObject\Dynamic;

use Noesis\Console\Util\Reader\ReaderInterface;
use Noesis\Console\Util\Reader\Stdin;

abstract class InputAbstract extends DynamicTerminalObject
{
    /**
     * The prompt text
     *
     * @var string $prompt
     */
    protected $prompt;

    /**
     * An instance of ReaderInterface
     *
     * @var \Noesis\Console\Util\Reader\ReaderInterface $reader
     */
    protected $reader;

    /**
     * Do it! Prompt the user for information!
     *
     * @return string
     */
    abstract public function prompt();

    /**
     * Format the prompt incorporating spacing and any acceptable options
     *
     * @return string
     */
    abstract protected function promptFormatted();
}
