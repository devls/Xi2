<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 14:53
 */
namespace Xi2\BootStrap;

class Kernel
{

    private $bios;
    private $cli;

    public function __construct( Bios $bios, $cli=false )
    {

        $this->bios = $bios;
        $this->cli = $cli;


    }

    public function run()
    {

    }

}
