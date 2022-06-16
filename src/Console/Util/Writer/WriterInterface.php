<?php
namespace Rist\Console\Util\Writer;

interface WriterInterface
{
    /**
     * @param  string $content
     *
     * @return void
     */
    public function write($content);
}
