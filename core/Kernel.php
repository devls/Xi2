<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 14:53
 */
namespace Xi2\Core;

class Kernel implements Definitions\Kernel
{

    private static $mySelf;

    /**
     * Constructs this \Xi2\Core\Kernel.
     *
     * @param Definitions\UriHandler $overrideUri
     * @throws Exception\General
     */
    public function __construct( Definitions\UriHandler $overrideUri = null)
    {

        if( !isset( self::$mySelf ) ) {
            self::$mySelf = $this;
        } else {
            throw new Exception\General( "Cannot boot a this Kernel more than once." );
        }

    }

    /**
     * Gets the Kernel instance.
     *
     * @static
     * @return Kernel
     */
    public static function get()
    {
        return self::$mySelf;
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function halt($noOutput = false)
    {
        // TODO: Implement halt() method.
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }

    public function service($handle, $instance)
    {
        // TODO: Implement service() method.
    }

    public function unregisterService($handle, $instance)
    {
        // TODO: Implement unregisterService() method.
    }


}
