<?php
namespace Rist\Console;

use Rist\Console\Argument\Manager as ArgumentManager;
use Rist\Console\Decorator\Style;
use Rist\Console\Settings\Manager as SettingsManager;
use Rist\Console\TerminalObject\Dynamic\Spinner;
use Rist\Console\TerminalObject\Router\Router;
use Rist\Console\Util\Helper;
use Rist\Console\Util\Output;
use Rist\Console\Util\UtilFactory;

/**
 * @method Console black(string $str = null)
 * @method Console red(string $str = null)
 * @method Console green(string $str = null)
 * @method Console yellow(string $str = null)
 * @method Console blue(string $str = null)
 * @method Console magenta(string $str = null)
 * @method Console cyan(string $str = null)
 * @method Console lightGray(string $str = null)
 * @method Console darkGray(string $str = null)
 * @method Console lightRed(string $str = null)
 * @method Console lightGreen(string $str = null)
 * @method Console lightYellow(string $str = null)
 * @method Console lightBlue(string $str = null)
 * @method Console lightMagenta(string $str = null)
 * @method Console lightCyan(string $str = null)
 * @method Console white(string $str = null)
 *
 * @method Console backgroundBlack(string $str = null)
 * @method Console backgroundRed(string $str = null)
 * @method Console backgroundGreen(string $str = null)
 * @method Console backgroundYellow(string $str = null)
 * @method Console backgroundBlue(string $str = null)
 * @method Console backgroundMagenta(string $str = null)
 * @method Console backgroundCyan(string $str = null)
 * @method Console backgroundLightGray(string $str = null)
 * @method Console backgroundDarkGray(string $str = null)
 * @method Console backgroundLightRed(string $str = null)
 * @method Console backgroundLightGreen(string $str = null)
 * @method Console backgroundLightYellow(string $str = null)
 * @method Console backgroundLightBlue(string $str = null)
 * @method Console backgroundLightMagenta(string $str = null)
 * @method Console backgroundLightCyan(string $str = null)
 * @method Console backgroundWhite(string $str = null)
 *
 * @method Console bold(string $str = null)
 * @method Console dim(string $str = null)
 * @method Console underline(string $str = null)
 * @method Console blink(string $str = null)
 * @method Console invert(string $str = null)
 * @method Console hidden(string $str = null)
 *
 * @method Console info(string $str = null)
 * @method Console comment(string $str = null)
 * @method Console whisper(string $str = null)
 * @method Console shout(string $str = null)
 * @method Console error(string $str = null)
 *
 * @method mixed out(string $str)
 * @method mixed inline(string $str)
 * @method mixed table(array $data)
 * @method mixed json(mixed $var)
 * @method mixed br($count = 1)
 * @method mixed tab($count = 1)
 * @method mixed draw(string $art)
 * @method mixed border(string $char = null, integer $length = null)
 * @method mixed dump(mixed $var)
 * @method mixed flank(string $output, string $char = null, integer $length = null)
 * @method mixed progress(integer $total = null)
 * @method Spinner spinner(string $label = null, string ...$characters = null)
 * @method mixed padding(integer $length = 0, string $char = '.')
 * @method mixed input(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method mixed confirm(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method mixed password(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method mixed checkboxes(string $prompt, array $options, Util\Reader\ReaderInterface $reader = null)
 * @method mixed radio(string $prompt, array $options, Util\Reader\ReaderInterface $reader = null)
 * @method mixed animation(string $art, TerminalObject\Helper\Sleeper $sleeper = null)
 * @method mixed columns(array $data, $column_count = null)
 * @method mixed clear()
 * @method Console clearLine()
 *
 * @method Console addArt(string $dir)
 */
class Console
{
    /**
     * An instance of the Style class
     *
     * @var \Rist\Console\Decorator\Style $style
     */
    public $style;

    /**
     * An instance of the Terminal Object Router class
     *
     * @var \Rist\Console\TerminalObject\Router\Router $router
     */
    protected $router;

    /**
     * An instance of the Settings Manager class
     *
     * @var \Rist\Console\Settings\Manager $settings
     */
    protected $settings;

    /**
     * An instance of the Argument Manager class
     *
     * @var \Rist\Console\Argument\Manager $arguments
     */
    public $arguments;

    /**
     * An instance of the Output class
     *
     * @var \Rist\Console\Util\Output $output
     */
    public $output;

    /**
     * An instance of the Util Factory
     *
     * @var \Rist\Console\Util\UtilFactory $util
     */
    protected $util;

    public function __construct()
    {
        $this->setStyle(new Style());
        $this->setRouter(new Router());
        $this->setSettingsManager(new SettingsManager());
        $this->setOutput(new Output());
        $this->setUtil(new UtilFactory());
        $this->setArgumentManager(new ArgumentManager());
    }

    /**
     * Set the style property
     *
     * @param \Rist\Console\Decorator\Style $style
     */
    public function setStyle(Style $style)
    {
        $this->style = $style;
    }

    /**
     * Set the router property
     *
     * @param \Rist\Console\TerminalObject\Router\Router $router
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Set the settings property
     *
     * @param \Rist\Console\Settings\Manager $manager
     */
    public function setSettingsManager(SettingsManager $manager)
    {
        $this->settings = $manager;
    }

    /**
     * Set the arguments property
     *
     * @param \Rist\Console\Argument\Manager $manager
     */
    public function setArgumentManager(ArgumentManager $manager)
    {
        $this->arguments = $manager;
    }

    /**
     * Set the output property
     *
     * @param \Rist\Console\Util\Output $output
     */
    public function setOutput(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Set the util property
     *
     * @param \Rist\Console\Util\UtilFactory $util
     */
    public function setUtil(UtilFactory $util)
    {
        $this->util = $util;
    }

    /**
     * Extend Console with custom methods
     *
     * @param string|object|array $class
     * @param string $key Optional custom key instead of class name
     *
     * @return \Rist\Console\Console
     */
    public function extend($class, $key = null)
    {
        $this->router->addExtension($key, $class);

        return $this;
    }

    /**
     * Force ansi support on
     *
     * @return \Rist\Console\Console
     */
    public function forceAnsiOn()
    {
        $this->util->system->forceAnsi();

        return $this;
    }

    /**
     * Force ansi support off
     *
     * @return \Rist\Console\Console
     */
    public function forceAnsiOff()
    {
        $this->util->system->forceAnsi(false);

        return $this;
    }

    /**
     * Write line to writer once
     *
     * @param string|array $writer
     *
     * @return \Rist\Console\Console
     */
    public function to($writer)
    {
        $this->output->once($writer);

        return $this;
    }

    /**
     * Output the program's usage statement
     *
     * @param array $argv
     */
    public function usage(array $argv = [])
    {
        $this->arguments->usage($this, $argv);
    }

    /**
     * Set the program's description
     *
     * @param string $description
     *
     * @return \Rist\Console\Console
     */
    public function description(string $description)
    {
        $this->arguments->description($description);

        return $this;
    }

    /**
     * Check if we have valid output
     *
     * @param  mixed   $output
     *
     * @return boolean
     */
    protected function hasOutput($output)
    {
        if (!empty($output)) {
            return true;
        }

        // Check for type first to avoid errors with objects/arrays/etc
        return ((is_string($output) || is_numeric($output)) && strlen($output) > 0);
    }

    /**
     * Search for the method within the string
     * and route it if we find one.
     *
     * @param  string $method
     * @param  string $name
     *
     * @return string The new string without the executed method.
     */
    protected function parseStyleMethod(string $method, string $name)
    {
        // If the name starts with this method string...
        if (substr($name, 0, strlen($method)) == $method) {
            // ...remove the method name from the beginning of the string...
            $name = substr($name, strlen($method));

            // ...and trim off any of those underscores hanging around
            $name = ltrim($name, '_');

            $this->style->set($method);
        }

        return $name;
    }

    /**
     * Search for any style methods within the name and apply them
     *
     * @param  string $name
     * @param  array $method_search
     *
     * @return string Anything left over after applying styles
     */
    protected function applyStyleMethods(string $name, string $method_search = null)
    {
        // Get all of the possible style attributes
        $method_search = $method_search ?: array_keys($this->style->all());

        $new_name = $this->searchForStyleMethods($name, $method_search);

        // While we still have a name left and we keep finding methods,
        // loop through the possibilities
        if (strlen($new_name) > 0 && $new_name != $name) {
            return $this->applyStyleMethods($new_name, $method_search);
        }

        return $new_name;
    }

    /**
     * Search for style methods in the current name
     *
     * @param string $name
     * @param array $search
     * @return string
     */
    protected function searchForStyleMethods(string $name, array $search)
    {
        // Loop through the possible methods
        foreach ($search as $method) {
            // See if we found a valid method
            $name = $this->parseStyleMethod($method, $name);
        }

        return $name;
    }

    /**
     * Build up the terminal object and return it
     *
     * @param string $name
     * @param array $arguments
     *
     * @return object|null
     */
    protected function buildTerminalObject(string $name, array $arguments)
    {
        // Retrieve the parser for the current set of styles
        $parser = $this->style->parser($this->util->system);

        // Reset the styles
        $this->style->reset();

        // Execute the terminal object
        $this->router->settings($this->settings);
        $this->router->parser($parser);
        $this->router->output($this->output);
        $this->router->util($this->util);

        return $this->router->execute($name, $arguments);
    }

    /**
     * Route anything leftover after styles were applied
     *
     * @param string $name
     * @param array $arguments
     *
     * @return object|null
     */
    protected function routeRemainingMethod(string $name, array $arguments)
    {
        // If we still have something left, let's figure out what it is
        if ($this->router->exists($name)) {
            $obj = $this->buildTerminalObject($name, $arguments);

            // If something was returned, return it
            if (is_object($obj)) {
                return $obj;
            }
        } elseif ($this->settings->exists($name)) {
            $this->settings->add($name, reset($arguments));
        // Handle passthroughs to the arguments manager.
        } else {
            // If we can't find it at this point, let's fail gracefully
            $this->out(reset($arguments));
        }
    }

    /**
     * Magic method for anything called that doesn't exist
     *
     * @param string $requested_method
     * @param array  $arguments
     *
     * @return \Rist\Console\Console|\Rist\Console\TerminalObject\Dynamic\DynamicTerminalObject
     *
     * List of many of the possible method being called here
     * documented at the top of this class.
     */
    public function __call(string $requested_method, array $arguments)
    {
        // Apply any style methods that we can find first
        $name = $this->applyStyleMethods(Helper::snakeCase($requested_method));

        // The first argument is the string|array|object we want to echo out
        $output = reset($arguments);

        if (strlen($name)) {
            // If we have something left, let's try and route it to the appropriate place
            if ($result = $this->routeRemainingMethod($name, $arguments)) {
                return $result;
            }
        } elseif ($this->hasOutput($output)) {
            // If we have fulfilled all of the requested methods and we have output, output it
            $this->out($output);
        }

        return $this;
    }
}
