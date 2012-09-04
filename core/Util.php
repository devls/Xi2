<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 11:41
 */

namespace Xi2; //This is a special class that exists in the Xi2 namespace.
/**
 * Utility Class Container
 */
class Util
{

    /**
     * Provides a reusable backend for the Util
     *
     * @static
     * @param callable $rule
     * @param $val
     * @param $alt
     * @param callable $valFormatter
     * @return mixed
     * @throws Core\Exception\General
     */
    private static function e( \Closure $rule, &$val, $alt, \Closure $valFormatter=null )
    {
        if( !is_callable( $rule ) )
            throw new Core\Exception\General( "Xi2\Core\Utils::e RULE is not callable!" );

        if( $rule( $val ) ) {
            if( is_callable( $valFormatter ) )
                return $valFormatter( $val );
            return $val;
        } else {
            return $alt;
        }

    }

    /**
     * Provides shorthand for isset code structures
     *
     * @static
     * @param $val
     * @param null $alt
     * @param \Closure $formatter
     * @return mixed
     */
    public static function eIsSet( &$val, $alt=null, \Closure $formatter=null )
    {
        return self::e( function( &$val ) {
            return isset( $val );
        }, $val, $alt, $formatter );
    }

    /**
     * Provides shorthand for !is_null/ !== null code structures
     *
     * @static
     * @param $val
     * @param null $alt
     * @param callable $formatter
     * @return mixed
     */
    public static function eIsNull( &$val, $alt=null, \Closure $formatter=null )
    {
        return self::e( function( &$val ) {
            return $val !== null;
        }, $val, $alt, $formatter );
    }


}
