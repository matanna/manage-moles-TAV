<?php

namespace App\Tests\Entity;

use App\Entity\RectiMachine;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RectiMachineTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $newRectiMachine = new RectiMachine();
        $newRectiMachine->setName('RectiMachineName8');

        return $newRectiMachine;
    }

    public function testNameRectiMachineIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testNameRectiMachineIsUniqueNoOk()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setName('RectiMachineName1'))->count());
    }

    public function testNameRectiMachineIsEmpty()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setName(''))->count());
    }

    public function testNameRectiMachineIsOneChar()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setName('a'))->count());
    }

    public function testNameRectiMachineIsTwentyChar()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setName('abcdefghijklmnopqrstu'))->count());
    }
    
}