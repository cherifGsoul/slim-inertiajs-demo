<?php
namespace Noesis\Console\TerminalObject\Dynamic;

class Password extends Input
{
    public function prompt()
    {
        $this->writePrompt();

        return $this->reader->hidden();
    }
}
