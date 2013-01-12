<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 16:10
 */
namespace Xi2\Shared\View;

use Xi2\Shared\Output\Definition;
use Xi2\Shared\Output\Base as OutputBase;

/**
 * View base
 */
abstract class Base extends OutputBase implements Definition
{

    /**
     * Handles redirects
     *
     * @param $method
     * @param $view
     * @param $module
     * @throws \Xi2\Core\Exception\Redirect
     */
    public function redirect( $method=null, $view=null, $module=null )
    {

        echo "redirect initiated";
        throw new \Xi2\Core\Exception\Redirect();

    }

    /**
     * Handles shutdown
     *
     * @return bool
     */
    public abstract function shutdown();

}
