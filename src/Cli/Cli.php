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
     * Version
     *
     * @var string
     */
    private static string $version;

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

    public static function setVersion(string $version)
    {
        self::$version = $version;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function intro()
    {
        self::$instance->white('Noesis Framework')->green(self::$version);
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
        $Padding = self::$instance->padding(30);

        self::$instance->green('help');
        self::$instance->tab();
        $Padding->label('.')->result('Display help documentation for the Noesis Console');

        self::$instance->green('list');
        self::$instance->tab();
        $Padding->label('.')->result('List all commands');

        self::$instance->green('pest');
        self::$instance->tab();
        $Padding->label('.')->result('Run all Pest tests');

        self::$instance->tab();
        $Padding->label(':init')->result('Initialize all pest files. Run this to setup tests folder in a new project');

        self::$instance->tab();
        $Padding->label(':cover')->result('Run all Pest tests with code coverage. Requires XDEBUG with env variable XDEBUG_MODE=coverage');

        self::$instance->green('create');
        self::$instance->tab();
        $Padding->label(':presenter -n {name}')->result('Generates boilerplate Presenter class in server/app/Presenter');

        self::$instance->tab();
        $Padding->label(':provider -n {name}')->result('Generates boilerplate Provider class in server/app/Providers');

        self::$instance->tab();
        $Padding->label(':react-page -n {name}')->result('Generates boilerplate React page in client/js/Pages');

        self::$instance->tab();
        $Padding->label(':react-component -n {name}')->result('Generates boilerplate React component in client/js/Components');
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


    public static function pestInit()
    {
        $path_to_pest = dirname(dirname(__DIR__)) . '/vendor/bin/pest';
        if (!file_exists($path_to_pest)) {
            self::$instance->error('Pest not found. Please ensure it is installed and the file /vendor/bin/pest exists');
            exit;
        }

        $command =  '--init';

        passthru("$path_to_pest $command");
    }

    public static function pest()
    {
        $path_to_pest = dirname(dirname(__DIR__)) . '/vendor/bin/pest';
        if (!file_exists($path_to_pest)) {
            self::$instance->error('Pest not found. Please ensure it is installed and the file /vendor/bin/pest exists');
            exit;
        }

        passthru("$path_to_pest");
    }

    public static function pestCoverage()
    {
        $path_to_pest = dirname(dirname(__DIR__)) . '/vendor/bin/pest';
        if (!file_exists($path_to_pest)) {
            self::$instance->error('Pest not found. Please ensure it is installed and the file /vendor/bin/pest exists');
            exit;
        }

        $command =  '--coverage';

        passthru("$path_to_pest $command");
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