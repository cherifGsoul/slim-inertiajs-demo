<?php
namespace Rist\Console\TerminalObject\Router;

use Rist\Console\Util\OutputImporter;

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
     * @param \Rist\Console\TerminalObject\Dynamic\DynamicTerminalObject $obj
     *
     * @return \Rist\Console\TerminalObject\Dynamic\DynamicTerminalObject
     */
    public function execute($obj)
    {
        $obj->output($this->output);

        return $obj;
    }
}
