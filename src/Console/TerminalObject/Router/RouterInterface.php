<?php
namespace Rist\Console\TerminalObject\Router;

interface RouterInterface
{
    /**
     * @param $class
     * @return string
     */
    public function path($class);

    /**
     * @param $class
     * @return boolean
     */
    public function exists($class);

    /**
     * @param $obj
     * @return null|\Rist\Console\TerminalObject\Dynamic\DynamicTerminalObject
     */
    public function execute($obj);

    /**
     * @return string
     */
    public function pathPrefix();
}
