<?php
namespace Noesis\Console\Decorator\Parser;

use Noesis\Console\Util\System\System;
use Noesis\Console\Decorator\Tags;

class ParserFactory
{
    /**
     * Get an instance of the appropriate Parser class
     *
     * @param System $system
     * @param array $current
     * @param Tags $tags
     * @return Parser
     */
    public static function getInstance(System $system, array $current, Tags $tags)
    {
        if ($system->hasAnsiSupport()) {
            return new Ansi($current, $tags);
        }

        return new NonAnsi($current, $tags);
    }
}
