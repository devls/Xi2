<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 03/09/12
 * Time: 19:31
 */
namespace Xi2\Core\Definitions;

interface UriHandler
{

    public function parse();

    public function getDomain();

    public function getGroup();

    public function getMode();

    public function getModule();

    public function getParams();

    public function getMethod();

    public function getClass();

}
