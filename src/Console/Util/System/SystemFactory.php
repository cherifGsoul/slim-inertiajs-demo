<?php
namespace Noesis\Console\Util\System;

class SystemFactory
{
    /**
     * @var \Noesis\Console\Util\System\System $instance
     */

    protected static $instance;

    /**
     * Get an instance of the appropriate System class
     *
     * @return \Noesis\Console\Util\System\System
     */

    public static function getInstance()
    {
        if (static::$instance) {
            return static::$instance;
        }

        static::$instance = self::getSystem();

        return static::$instance;
    }

    /**
     * Set the $instance property to the appropriate system
     *
     * @return \Noesis\Console\Util\System\System
     */

    protected static function getSystem()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return new Windows();
        }

        return new Linux();
    }
}
