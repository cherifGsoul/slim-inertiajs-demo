<?php
namespace Noesis\Console\TerminalObject\Router;

use Noesis\Console\Util\Helper;
use Noesis\Console\Util\OutputImporter;

class BasicRouter extends BaseRouter
{
    use OutputImporter;

    /**
     * @return string
     */
    public function pathPrefix()
    {
        return 'Basic';
    }

    /**
     * Execute a basic terminal object
     *
     * @param \Noesis\Console\TerminalObject\Basic\BasicTerminalObject $obj
     * @return void
     */
    public function execute($obj)
    {
        $results = Helper::toArray($obj->result());

        $this->output->persist();

        foreach ($results as $result) {
            if ($obj->sameLine()) {
                $this->output->sameLine();
            }

            $this->output->write($obj->getParser()->apply($result));
        }

        $this->output->persist(false);
    }
}
