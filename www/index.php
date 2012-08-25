<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 14:20
 */

namespace Xi2\BootStrap;

/**
 * Define this Xi\BootStrap\Entry
 */
class Bios {

    private static $kernel;

    /**
     *
     */
    public function __construct()
    {

    }

    public function getArguments()
    {

    }

    /**
     * @static
     */
    public static function begin()
    {
        if(isset($_SERVER['argc']))
        self::$kernel = new Kernel(
            new Bios(),
            isset($_SERVER['argc'])
        );

        self::$kernel->run();

    }

    /**
     * @static
     */
    private static function end()
    {
        unset( self::$kernel );
    }

}

Bios::begin();