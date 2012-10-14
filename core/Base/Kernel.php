<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 14/10/12
 * Time: 12:33
 */
namespace Xi2\Core\Base;

abstract class Kernel
{

    /* @var Kernel */
    protected static $mySelf;

    /**
     * Gets an instance of the kernel.
     *
     * @return Kernel
     */
    public static function get()
    {

        return self::$mySelf;

    }


}
