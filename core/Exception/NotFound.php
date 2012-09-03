<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 10:52
 */
namespace Xi2\Core\Exception;

class NotFound extends Exception
{
    private $path;

    public function __construct( \Exception $previous=null )
    {

        $uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        $message =
            "File not found at $uri";

        parent::__construct( $message, '404', $previous);

    }

}
