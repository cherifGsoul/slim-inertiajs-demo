<?php
namespace Rist\Console\TerminalObject\Dynamic;

use Rist\Console\Decorator\Parser\ParserImporter;
use Rist\Console\Settings\SettingsImporter;
use Rist\Console\Util\OutputImporter;
use Rist\Console\Util\UtilImporter;

/**
 * The dynamic terminal object doesn't adhere to the basic terminal object
 * contract, which is why it gets its own base class
 */

abstract class DynamicTerminalObject implements DynamicTerminalObjectInterface
{
    use SettingsImporter, ParserImporter, OutputImporter, UtilImporter;
}
