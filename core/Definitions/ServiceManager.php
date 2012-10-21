<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 10:49
 */
namespace Xi2\Core\Definitions;

interface ServiceManager
{

    /**
     * Register
     *
     * @param $handle
     * @param Service $instance
     * @return mixed
     */
    public function register( $handle, Service $instance );


    /**
     * Unregister
     *
     * @param $handle
     * @return mixed
     */
    public function unregister( $handle );

    /**
     * Get
     *
     * @param $handle
     * @return mixed
     */
    public function get( $handle );


}
