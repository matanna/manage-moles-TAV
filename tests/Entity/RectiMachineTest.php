<?php

namespace App\Tests\Entity;

use App\Entity\RectiMachine;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RectiMachineTest extends KernelTestCase
{
    use EntityTestTrait;

    public function testNameRectiMachineIsUniqueOk()
    {
        $newRectiMachine = new RectiMachine();
        $newRectiMachine->setName('RectiMachineName8');

        $this->assertSame(0, $this->validator->validate($newRectiMachine)->count());
    }

    public function testNameRectiMachineIsUniqueNoOk()
    {
        $newRectiMachine = new RectiMachine();
        $newRectiMachine->setName('RectiMachineName1');
        
        $this->assertSame(1, $this->validator->validate($newRectiMachine)->count());
    }
}