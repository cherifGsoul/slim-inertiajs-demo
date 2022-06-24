<?php
namespace Noesis\Console\Decorator\Parser;

trait ParserImporter
{
    /**
     * An instance of the Parser class
     *
     * @var \Noesis\Console\Decorator\Parser\Parser $parser
     */
    protected $parser;

    /**
     * Import the parser and set the property
     *
     * @param \Noesis\Console\Decorator\Parser\Parser $parser
     */
    public function parser(Parser $parser)
    {
        $this->parser = $parser;
    }
}
