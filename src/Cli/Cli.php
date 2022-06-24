<?php declare(strict_types=1);
namespace Noesis\Cli;

use Noesis\Console\Console;

/**
 * @method void createPresenter(Console $Console, string $to_make)
 * @method void createReactPage(Console $Console, string $to_make)
 * @method void createReactComponent(Console $Console, string $to_make)
 * @method void createProvider(Console $Console, string $to_make)
 */
class Cli
{
    /**
     * instance
     *
     * @var Console|null
     */
    private static $instance = null;

    /**
     * Argv
     *
     * @var array
     */
    private static array $argv;

    /**
     * Arguments
     *
     * @var array
     */
    private static array $arguments;

    public static function createFrom(array $argv, array $argument_definitions)
    {
        if (!isset(self::$instance)) {
            $Console = new Console;
            $Console->arguments->add($argument_definitions);
            $Console->arguments->parse($argv);
            self::$arguments = $Console->arguments->all();
            self::$instance = $Console;
            self::$argv = $argv;
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function intro()
    {
        self::$instance->white('Noesis Framework')->green('0.1.0');
        self::$instance->description("Noesis (React, InertiaJS, Tailwind, Slim) is a fully extensible framework with easy SPA routing using InertiaJS");
        self::$instance->br();
    }

    public static function hasArguments(): bool
    {
        return self::$instance->arguments->hasArguments();
    }

    public static function displayUsage()
    {
        self::$instance->animation('noesis.slant')->enterFrom('top');
        self::$instance->usage();
        self::$instance->br();
    }

    public static function listAllCommands()
    {
        self::$instance->out('List of commands:');
        self::$instance->green('help');
        $Padding = self::$instance->padding(10);
        self::$instance->tab();
        $Padding->label('help')->result('Display help documentation for the Noesis Console');
    }

    public static function unknownCommandError()
    {
        $argv = self::$argv;
        self::$instance->error("Unknown command: {$argv[1]}");
    }

    public static function create(string $to_make)
    {
        switch (strtolower($to_make)) {
            case 'presenter' :
                self::createPresenter(self::$instance, $to_make);
            break;
            case 'react_page' :
            case 'react-page' :
            case 'reactpage' :
                self::createReactPage(self::$instance, $to_make);
            break;
            case 'react-component':
            case 'react_component' :
            case 'reactcomponent' :
                self::createReactComponent(self::$instance, $to_make);
            break;
            case 'provider':
                self::createProvider(self::$instance, $to_make);
            break;
            default :
                self::unknownCommandError();
            break;
        }
    }

    public static function __callStatic(string $method, array $parameters)
    {
        preg_match('/^([a-z]+)?([A-Z]\w+)$/', $method, $matches);

        if (!count($matches) >= 3) {
            self::$instance->error('Could not match a class for $method');
        }

        $folder = ucfirst($matches[1]);
        $class_name = $matches[2];
        
        $fully_qualified_name = "\\Noesis\\Cli\\$folder\\$class_name";
        if (!class_exists($fully_qualified_name)) {
            self::$instance->error('Could not resolve a class for $method. Confirm the namespace and className are correct');
        }

        $Class = new $fully_qualified_name(self::$instance);
        $Class();
    }
}