<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 11:41
 */
namespace Xi2\Core;

/**
 * Utility Class Container
 */
class Utils
{

    /**
     * @static
     * @param callable $rule
     * @param $val
     * @param $alt
     * @param callable $valFormatter
     * @return mixed
     * @throws Exception
     */
    private static function e( \Closure $rule, &$val, $alt, \Closure $valFormatter=null )
    {
        if( !is_callable( $rule ) )
            throw new \Xi2\Core\Exception( "Xi2\Core\Utils::e RULE is not callable!" );

        if( $rule( $val ) ) {
            if( is_callable( $valFormatter ) )
                return $valFormatter( $val );
            return $val;
        } else {
            return $alt;
        }

    }

    /**
     * @static
     * @param $val
     * @param null $alt
     * @param Closure $formatter
     * @return mixed
     */
    public static function eisset( &$val, $alt=null, Closure $formatter=null )
    {
        return self::e( function( &$val ) {
            return $val !== null;
        }, $val, $alt, $formatter );
    }

}
