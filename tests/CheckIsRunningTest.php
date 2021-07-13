<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckIsRunningTest extends KernelTestCase
{
    public function testIsRun()
    {
        self::bootKernel();

        $this->assertEquals(2, 1+1);
    }
}