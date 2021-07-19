<?php

namespace App\Tests\Entity;

use App\Entity\Position;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\RectiMachine;

class PositionTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $rectiMachine = $this->manager->getRepository(RectiMachine::class)->findOneBy(['id' => 1]);

        $position = (new Position())
            ->setName('position8')
            ->setStockMini(5)
            ->setStockReal(6)
            ->setTotalNotDelivered(2)
            ->setRectiMachine($rectiMachine);

        return $position;
    }

    public function testNamePositionIsNull()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setName(''))->count());
    }

    public function testStockMiniPositionIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setStockMini(-1))->count());
    }

    public function testStockRealPositionIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setStockReal(-1))->count());
    }

    public function testAdditionStockWheelsRectiMachineForStockRealInPosition()
    {
        $position = $this->manager->getRepository(Position::class)->findOneBy(['name' => 'RectiMachineName1position1']);

        $stockExpected = 0;

        foreach ($position->getWheelsRectiMachines() as $wheels) {
            $stockExpected += $wheels->getStock();
        }

        $this->assertEquals($stockExpected, $position->getStockReal());
    }

    public function testTotalNotDeliveredRealWheelsRectiMachineTypeIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setTotalNotDelivered(-1))->count());
    }

    public function testAdditionTotalNotDeliveredWheelsRectiMachineForStockRealInPosition()
    {
        $position = $this->manager->getRepository(Position::class)->findOneBy(['name' => 'RectiMachineName1position1']);

        $totalNotDeliveredExpected = 0;

        foreach ($position->getWheelsRectiMachines() as $wheels) {
            $totalNotDeliveredExpected += $wheels->getNotDelivered();
        }

        $this->assertEquals($totalNotDeliveredExpected, $position->getTotalNotDelivered());
    }  
}