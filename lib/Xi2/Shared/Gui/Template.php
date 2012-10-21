<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 27/08/12
 * Time: 09:59
 */
namespace Xi2\Shared\Gui;
use Xi2\Core\Definitions\Renderable;

/**
 * The template standard code
 */
abstract class Template implements Renderable
{

    /**
     *
     *
     * @param $templateFile
     * @return Pseudo\Template
     */
    public static function getPseudo( $templateFile )
    {


        return new Pseudo\Template();
    }

}
