<?php
namespace Rist\Console\Decorator\Parser;

trait ParserImporter
{
    /**
     * An instance of the Parser class
     *
     * @var \Rist\Console\Decorator\Parser\Parser $parser
     */
    protected $parser;

    /**
     * Import the parser and set the property
     *
     * @param \Rist\Console\Decorator\Parser\Parser $parser
     */
    public function parser(Parser $parser)
    {
        $this->parser = $parser;
    }
}
