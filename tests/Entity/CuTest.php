<?php

namespace App\Tests\Entity;

use App\Entity\Cu;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CuTest extends KernelTestCase
{
    use EntityTestTrait;

    public function testNameCuIsUniqueOk()
    {
        $newCu = new Cu();
        $newCu->setName('cuName8');

        $this->assertSame(0, $this->validator->validate($newCu)->count());
    }

    public function testNameCuIsUniqueNoOk()
    {
        $newCu = new Cu();
        $newCu->setName('cuName1');

        $this->assertEquals(1, $this->validator->validate($newCu)->count());
    }
}