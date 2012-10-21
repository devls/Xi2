<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 10:35
 */
namespace Xi2\Core\Definitions;

interface Kernel
{

    public function __construct( UriHandler $overrideUri=null );

    public function boot();

    public function halt( $noOutput=false );

    public function flush();

    /**
     * Gets a Service from the Kernel
     *
     * @param $handle
     * @return Service|null
     */
    public function getService( $handle );

    /**
     * Registers a service with the Kernel.
     *
     * @param $handle
     * @param Service $instance
     * @return Service
     */
    public function registerService( $handle, Service $instance );

    /**
     * Unregisters a service with the Kernel.
     *
     * @param $handle
     * @return bool
     */
    public function unregisterService( $handle );

}
