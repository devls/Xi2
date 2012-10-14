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

    /* @var array */
    private $namespaces;

    /**
     * Constructs this \Xi2\Core\Kernel.
     *
     * @param Definitions\UriHandler $overrideUri
     * @throws Exception\General
     */
    public function __construct( Definitions\UriHandler $overrideUri = null,
                                 array $customPaths = array(),
                                 array $namespaces = array() )
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

        $this->namespaces = array_merge(
            $namespaces,
            array(
                'Xi2'
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


            $found = false;
            foreach( $this->namespaces as $space ) {
                if ( class_exists( $space.$className ) ) {
                    $found = true;
                    $className = $space.$className;
                    break;
                }
            }

            if( !$found ) {
                throw new Exception\NotFound();
            }


            $obj = new $className();

            $method = $this->uriHandler->getMethod();

            if( !method_exists( $obj, $method ) ) {
                throw new Exception\NotFound();
            }

            call_user_func_array(
                array(
                    $obj,
                    $method
                ),
                $this->uriHandler->getParams()
            );

        } catch ( Exception\NotFound $e ) {

            //TODO: Replace this logic
            echo "Not Found";

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
