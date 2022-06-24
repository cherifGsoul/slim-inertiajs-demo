<?php
namespace Noesis\Console\TerminalObject\Dynamic;

use Noesis\Console\Decorator\Parser\Parser;
use Noesis\Console\Util\UtilFactory;

interface DynamicTerminalObjectInterface
{
    public function settings();

    /**
     * @param $setting
     * @return void
     */
    public function importSetting($setting);

    /**
     * @param \Noesis\Console\Decorator\Parser\Parser $parser
     */
    public function parser(Parser $parser);

    /**
     * @param UtilFactory $util
     */
    public function util(UtilFactory $util);
}
