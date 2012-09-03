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

    public static function get();

    public function boot();

    public function halt( $noOutput=false );

    public function flush();

    public function service( $handle, $instance );

    public function unregisterService( $handle, $instance );

}
