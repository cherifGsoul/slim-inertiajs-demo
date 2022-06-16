<?php
namespace Rist\Console\TerminalObject\Basic;

use Rist\Console\Decorator\Parser\ParserImporter;
use Rist\Console\Settings\SettingsImporter;
use Rist\Console\Util\UtilImporter;

abstract class BasicTerminalObject implements BasicTerminalObjectInterface
{
    use SettingsImporter, ParserImporter, UtilImporter;

    /**
     * Set the property if there is a valid value
     *
     * @param string $key
     * @param string $value
     */
    protected function set(string $key, string $value)
    {
        if (strlen($value)) {
            $this->$key = $value;
        }
    }

    /**
     * Get the parser for the current object
     *
     * @return \Rist\Console\Decorator\Parser\Parser
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * Check if this object requires a new line to be added after the output
     *
     * @return boolean
     */
    public function sameLine()
    {
        return false;
    }
}
