<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 14:53
 */
namespace Xi2\Core;

use \Xi2\Core\Base\Kernel as KernelAbstract;
use \Xi2\Core\Libraries\Utils\Generic;


/**
 *
 */
class Kernel extends KernelAbstract implements Definitions\Kernel
{

    /* @var Definitions\UriHandler */
    private $uriHandler;

    /* @var array */
    private $paths;

    /**
     * Constructs this \Xi2\Core\Kernel.
     *
     * @param Definitions\UriHandler $overrideUri
     * @throws Exception\General
     */
    public function __construct( Definitions\UriHandler $overrideUri = null, array $customPaths = array() )
    {

        if( !isset( self::$mySelf ) ) {
            self::$mySelf = $this;
        } else {
            throw new Exception\General( "Cannot boot ". __NAMESPACE__.__CLASS__ ." more than once." );
        }

        $this->uriHandler = Generic::eIsNull( $overrideUri, new UriHandler() );

        $this->paths = array_merge(
            $customPaths,
            array(
                __DIR__.'/../lib/'
            )
        );

    }

    /**
     *
     */
    public function boot()
    {
        //An autoloader with greater powers.

        $kernel = $this;
        spl_autoload_register(
            function( $class ) use ( $kernel ) {

                $class = explode( '\\', trim( $class, '\\' ) );

                if( count( $class ) < 4 ) {
                    return false;
                }

                $found = false;
                foreach( $kernel->paths as $path ) {

                    $check = Bootstrap::doFileInclude(
                        $path .
                        implode( '/', $class )
                        . '.php'
                    );

                    if( $check ) {
                        $found = true;
                        break;
                    }

                }

                return $found;

            }
        );

        $this->callView();

    }

    /**
     *
     */
    private function callView()
    {
        try {

            $this->uriHandler->parse();

            $className = '\\'.
                $this->uriHandler->getModule() . '\\'.
                $this->uriHandler->getMode() . '\\' .
                $this->uriHandler->getClass();

            $obj = new $className();

            call_user_func_array(
                array(
                    $obj,
                    $this->uriHandler->getMethod()
                ),
                $this->uriHandler->getParams()
            );

        } catch ( Exception\NotFound $e ) {



        } catch ( \Exception $e ) {

        }
    }

    public function halt( $noOutput = false )
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
