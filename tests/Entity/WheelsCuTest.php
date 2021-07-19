<?php

namespace App\Tests\Entity;

use App\Entity\WheelsCu;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WheelsCuTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $newWheelsCu = (new WheelsCu())
            ->setRef('Ref8')
            ->setTavName('tavname')
            ->setDiameter(155)
            ->setHeight(40)
            ->setGrain('grain');

        return $newWheelsCu;
    }

    public function testRefWheelsCuIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testRefWheelsCuIsUniqueNoOk()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setRef('cuName1type1Ref1'))->count());
    }

    public function testRefWheelsCuIsNull()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setRef(''))->count());
    }

    public function testDiameterWheelsCuIsNull()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setDiameter(0))->count());
    }

    public function testDiameterWheelsCuIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setDiameter(-1))->count());
    }

    public function testStockWheelsCuIsNull()
    {
        $this->assertEquals(0, $this->validator->validate($this->create()->setStock(0))->count());
    }

    public function testStockWheelsCuIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setStock(-1))->count());
    }

    public function testNotDeliveredWheelsCuIsNull()
    {
        $this->assertEquals(0, $this->create()->getNotDelivered());
    }

    public function testNotDeliveredWheelsCuIsNegative()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setNotDelivered(-1))->count());
    }
    
}
