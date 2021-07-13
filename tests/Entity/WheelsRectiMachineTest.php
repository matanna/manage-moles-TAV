<?php

namespace App\Tests\Entity;

use App\Entity\WheelsRectiMachine;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WheelsRectiMachineTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();

        $wheelsRectiMachine->setRef('Ref8')            
                              ->setTAVname('TAVname8')
                              ->setDiameter(158);
        
        return $wheelsRectiMachine;
    } 

    public function testWheelsRectiMachineIsOk()
    {
        $wheelsRectiMachine = $this->create();
        
        $this->assertSame(0, $this->validator->validate($wheelsRectiMachine)->count());
    }

    public function testRefWheelsRectiMachineIsUniqueNoOk()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();
        $wheelsRectiMachine->setRef('Ref1');

        $this->assertEquals(1, $this->validator->validate($wheelsRectiMachine)->count());
    }

    public function testStockWheelsRectiMachineIsNull()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();
        $wheelsRectiMachine->getStock();

        $this->assertEquals(0, $wheelsRectiMachine->getStock());
    }

    public function testStockWheelsRectiMachineIsNotNull()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();
        $wheelsRectiMachine->setStock(8);

        $this->assertEquals(8, $wheelsRectiMachine->getStock());
    }

     public function testNotDeliveredWheelsRectiMachineIsNull()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();
        $wheelsRectiMachine->getNotDelivered();

        $this->assertEquals(0, $wheelsRectiMachine->getNotDelivered());
    }

    public function testNotDeliveredWheelsRectiMachineIsNotNull()
    {
        $wheelsRectiMachine = new WheelsRectiMachine();
        $wheelsRectiMachine->setNotDelivered(8);

        $this->assertEquals(8, $wheelsRectiMachine->getNotDelivered());
    }
}