<?php
namespace Noesis\Console\TerminalObject\Dynamic;

use Noesis\Console\Decorator\Parser\ParserImporter;
use Noesis\Console\Settings\SettingsImporter;
use Noesis\Console\Util\OutputImporter;
use Noesis\Console\Util\UtilImporter;

/**
 * The dynamic terminal object doesn't adhere to the basic terminal object
 * contract, which is why it gets its own base class
 */

abstract class DynamicTerminalObject implements DynamicTerminalObjectInterface
{
    use SettingsImporter, ParserImporter, OutputImporter, UtilImporter;
}
