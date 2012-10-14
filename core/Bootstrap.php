<?php

namespace Xi2\Core;
use \Xi2\Core\Libraries\Utils\Generic as Generic;
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 10:22
 */
class Bootstrap
{
    /* @var \Xi2\Core\Definitions\Kernel */
    private static $kernel;

    /* @var array */
    private static $supports = array();

    /**
     * Includes a file.
     *
     * @static
     * @param $path
     * @return bool
     */
    public static function doFileInclude( $path )
    {

        $path = $path.'.php';
        echo $path;
        if( file_exists( $path ) ) {

            include $path;
            return true;

        } else {

            return false;

        }
    }

    /**
     * Starts Xi2. Sets up Core class autoloading.
     *
     * @param bool $noBoot
     * @static
     */
    public static function go( $noBoot=false )
    {
        error_reporting( -1 );
        gc_enable();

        spl_autoload_register (
            function( $class ) {

                $class = explode( '\\', $class );

                if( count($class) > 2 && $class[0] == 'Xi2' && $class[1] == 'Core' )
                {
                    array_shift( $class ) && array_shift( $class );
                    Bootstrap::doFileInclude( __DIR__ . '/' . implode( '/', $class ) );
                }

            }
        );
        self::$kernel = new Kernel();
        if( $noBoot ) {

            //Instantiate but do not boot the Kernel. This will cause auto-loaders to be loaded but nothing else.
            return;
        }

        self::boot(); //Boot will now execute this runcycle.

        self::end(); //When everything is finished, wind it all down.
    }

    /**
     * End a Kernel runtime
     *
     * @static
     */
    public static function end()
    {
        self::$kernel->halt();

        //Force Kernel __destruct
        self::$kernel = null;
        gc_collect_cycles();

    }

    /**
     * Protect from fatal errors.
     *
     * @static
     */
    private static function fatalErrorProtection()
    {
        //Generic error handler logic
        $handler = function( $code, $message, $file, $line ) {
            echo "Code: {$code}, $message in $file on line $line";
        };

        //Use it for errors
        set_error_handler( $handler );

        register_shutdown_function(
            function() use ( $handler ) {
                $error = error_get_last();
                if( $error !== null ) {
                    $handler( $error['type'], $error['message'], $error['file'], $error['line'] );
                }
            }
        );

    }

    /**
     * Boot the Kernel
     *
     * @static
     */
    private static function boot()
    {

        try{

            self::$kernel->boot();

        } catch ( Exception\Exception $e ) {

            $uri = new UriHandler( "Xi2://error/" );

            $kernel = new Kernel( $uri );
            $kernel->service( 'Exception', $e );

            self::reboot( $kernel );

        } catch ( \Exception $e ) {

            $uri = new UriHandler( "Xi2://error/#unknown" );

            $kernel = new Kernel( $uri );
            $kernel->service( 'Exception', $e );

            self::reboot( $kernel );

        }
    }

    /**
     * Reboot the Kernel
     *
     * @static
     * @param Definitions\Kernel $kernelInstance
     */
    public static function reboot( \Xi2\Core\Definitions\Kernel $kernelInstance )
    {
        //If we're replacing the Kernel make sure the previous one knows we are to shutdown without output
        self::$kernel->shutdown();
        unset( self::$kernel ); //Unset the old.

        //Save and start up the new Kernel.
        self::$kernel = $kernelInstance;
        self::boot();
    }

    /**
     * Gets or Sets whether $handle is supported.
     * Where $handle is something that may or may not be supported at runtime
     * by the system.
     *
     * @static
     * @param $handle
     * @param bool $value
     * @return bool
     */
    public static function supports( $handle, $value=null )
    {
        if( $value !== null ) {
            self::$supports[ $handle ] = (bool) $value;
        }

        return Generic::eIsSet( self::$supports[ $handle ] );

    }
}
