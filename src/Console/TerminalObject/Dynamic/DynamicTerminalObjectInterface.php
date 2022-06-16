<?php
namespace Rist\Console\TerminalObject\Dynamic;

use Rist\Console\Decorator\Parser\Parser;
use Rist\Console\Util\UtilFactory;

interface DynamicTerminalObjectInterface
{
    public function settings();

    /**
     * @param $setting
     * @return void
     */
    public function importSetting($setting);

    /**
     * @param \Rist\Console\Decorator\Parser\Parser $parser
     */
    public function parser(Parser $parser);

    /**
     * @param UtilFactory $util
     */
    public function util(UtilFactory $util);
}
