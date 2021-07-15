<?php

namespace App\Tests\Entity;

use App\Entity\Cu;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CuTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $newCu = new Cu();
        $newCu->setName('cuName8');

        return $newCu;
    }

    public function testNameCuIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testNameCuIsUniqueNoOk()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('cuName1'))->count());
    }

    public function testNameCuIsEmpty()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName(''))->count());
    }

    public function testNameCuIsOneChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('a'))->count());
    }

    public function testNameCuIsTwentyOneChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('abcdefghijklmnopqrstu'))->count());
    }
}
