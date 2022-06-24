<?php
namespace Noesis\Console\TerminalObject\Basic;

use Noesis\Console\Decorator\Parser\Parser;
use Noesis\Console\Util\UtilFactory;

interface BasicTerminalObjectInterface
{
    public function result();

    public function settings();

    /**
     * @param $setting
     * @return void
     */
    public function importSetting($setting);

    /**
     * @return boolean
     */
    public function sameLine();

    /**
     * @param \Noesis\Console\Decorator\Parser\Parser $parser
     */
    public function parser(Parser $parser);

    /**
     * @param UtilFactory $util
     */
    public function util(UtilFactory $util);
}
