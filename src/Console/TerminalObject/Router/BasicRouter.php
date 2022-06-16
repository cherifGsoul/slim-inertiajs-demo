<?php
namespace Rist\Console\TerminalObject\Router;

use Rist\Console\Util\Helper;
use Rist\Console\Util\OutputImporter;

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
     * @param \Rist\Console\TerminalObject\Basic\BasicTerminalObject $obj
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