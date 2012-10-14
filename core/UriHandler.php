<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 11:00
 */
namespace Xi2\Core;

/**
 * Parses incoming Uri's in the following format described below.
 *
 * //<domain>/[<junk>/]+<api|view|*>/<module>/<group|0>/<view>/<method>[/!/[<params>/]+}
 *
 * @author Craig Bass <craig@devls.co.uk>
 */
class UriHandler implements Definitions\UriHandler
{


    private $domain;
    private $mode;
    private $module;
    private $group;
    private $class;
    private $method;

    /* @var array */
    private $params;

    private $parts;


    /**
     * Constructs this UriHandler. Actually does some initial parsing.
     *
     */
    public function __construct(  )
    {

        if( !isset( $_SERVER['REQUEST_URI'] ) ) {
            return;
        }

        $request = explode( '!', $_SERVER['REQUEST_URI'] );

        $request = array_map(
            function( $part ) {
                return trim( $part, '/' );
            },
            $request
        );

        $parts = array();

        $index = 0;
        foreach( $request as $part ) {

            $part = explode( '/', $part );

            if( $index ) {
                $parts = array_merge( $parts, $part );
                break;
            }

            $count = count( $part ) - 1;

            for( $i = $count - 4; $i <= $count; $i++ ) {
                if( $i < 0 ) {
                    continue;
                }
                $parts[] = $part[ $i ];
            }
            $index++;

        }

        $this->parts = $parts;

    }

    /**
     * Finishes parsing and checks if valid.
     *
     * @throws Exception\NotFound
     */
    public function parse()
    {
        /*
         * Determine if valid.
         */
        if( count( $this->parts ) < 5 ) {
            throw new Exception\NotFound( );
        }

        /*
         * Extract the mode
         */
        if( in_array( $this->parts[0], array( 'api', 'view' ), true ) ) {
            throw new Exception\NotFound( );
        }
        $this->mode = $this->parts[0];

        /*
         * Extract the module
         */
        $this->module = $this->parts[1];

        /*
         * Extract the group
         */
        $this->group = $this->parts[2];

        /*
         * Extract the class
         */
        $this->class = $this->parts[3];

        /*
         * Extract the method
         */
        $this->method = $this->parts[4];

        /*
         * Extract the params
         */
        $this->params = array_slice( $this->parts, 5 );

        /*
         * Extract the domain
         */
        $this->domain = null;//TODO: Make this work

    }


    /**
     * Gets the domain from the Uri
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Gets the group from the Uri
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Gets the mode from the Uri
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Gets the module from the Uri
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Gets the params from the Uri
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Gets the class from the Uri
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Gets the Method from the Uri
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }



}
