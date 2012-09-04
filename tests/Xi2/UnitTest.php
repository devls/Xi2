<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 04/09/12
 * Time: 21:48
 */
use Xi2\Core\Test\Base as TestCase;
use Xi2\Core\Kernel as Kernel;
use Xi2\Core\Definitions\Kernel as KernelDefinition;

class UnitTest extends TestCase
{

    /**
     * A simple test to test that Unit Tests work.
     */
    public function testUnitTesting () {

        $this->assertTrue( Kernel::get() instanceof KernelDefinition );

    }

}
