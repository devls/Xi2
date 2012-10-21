<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 10:44
 */
namespace Xi2\Core;

use Xi2\Core\Libraries\Utils\Generic as Generic;

class ServiceManager implements Definitions\ServiceManager
{
    /* @var array */
    private $services;

    /**
     * Register
     *
     * @param $handle
     * @param Definitions\Service $instance
     * @return Definitions\Service
     */
    public function register( $handle, Definitions\Service $instance )
    {
        return $this->services[$handle] = $handle;
    }

    /**
     * Unregister
     *
     * @param $handle
     * @return bool
     */
    public function unregister( $handle )
    {

        return Generic::eIsSet(
            $this->services[$handle],
            false,
            function( &$val ) {
                unset( $val );
                return true;
            }
        );

    }

    /**
     * Get
     *
     * @param $handle
     * @return bool
     */
    public function get( $handle )
    {
        return Generic::eIsSet( $this->services[$handle] );
    }


}
