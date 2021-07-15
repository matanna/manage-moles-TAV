<?php

namespace App\Tests\Entity;

use App\Entity\Position;
use App\Entity\WheelsRectiMachine;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WheelsRectiMachineTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $position = $this->manager->getRepository(Position::class)->findOneBy(['id' => 1]);

        $wheelsRectiMachine = (new WheelsRectiMachine())
                              ->setRef('Ref8')            
                              ->setTAVname('TAVname8')
                              ->setGrain('grain')
                              ->setDiameter(158)
                              ->setHeight(40)
                              ->setPosition($position);
        
        return $wheelsRectiMachine;
    } 

    public function testWheelsRectiMachineIsOk()
    {
        //dd($this->validator->validate($this->create()));
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testRefWheelsRectiMachineIsUniqueNoOk()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setRef('RectiMachineName1position1wheels1'))->count());
    }

    public function testRefWheelsRectiMachineIsNull()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setRef(''))->count());
    }

    public function testDiamterWheelsRectiMachineIsNull()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setDiameter(0))->count());
    }

    public function testDiamterWheelsRectiMachineIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setDiameter(-1))->count());
    }

    public function testStockWheelsRectiMachineIsNull()
    {
        $this->assertEquals(0, $this->create()->getStock());
    }

    public function testStockWheelsRectiMachineIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setStock(-1))->count());
    }

    public function testNotDeliveredWheelsRectiMachineIsNull()
    {
        $this->assertEquals(0, $this->create()->getNotDelivered());
    }

    public function testNotDeliveredWheelsRectiMachineIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setNotDelivered(-1))->count());
    }
}