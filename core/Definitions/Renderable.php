<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 14/10/12
 * Time: 22:06
 */
namespace Xi2\Core\Definitions;

/**
 * Defines renderable objects that can be used by the Kernel.
 */
interface Renderable
{

    /**
     * Renders the output
     *
     * @return void
     */
    public function render();


    /**
     * Handles shutdown
     *
     * @return mixed
     */
    public function shutdown();

}
