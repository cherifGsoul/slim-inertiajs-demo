<?php
namespace Noesis\Console\TerminalObject\Router;

use Noesis\Console\Util\OutputImporter;

class DynamicRouter extends BaseRouter
{
    use OutputImporter;

    /**
     * @return string
     */
    public function pathPrefix()
    {
        return 'Dynamic';
    }

    /**
     * Execute a dynamic terminal object using given arguments
     *
     * @param \Noesis\Console\TerminalObject\Dynamic\DynamicTerminalObject $obj
     *
     * @return \Noesis\Console\TerminalObject\Dynamic\DynamicTerminalObject
     */
    public function execute($obj)
    {
        $obj->output($this->output);

        return $obj;
    }
}
