<?php

namespace App\Tests\Entity;

use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WheelsCuTypeTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $category = $this->manager->getRepository(CuCategories::class)->findOneBy(['id' => 1]);

        $newWheelsCuType = (new WheelsCuType())
            ->setType('type8')
            ->setStockMini(4)
            ->setStockReal(1)
            ->setTotalNotDelivered(2)
            ->setCuCategory($category);
            
        return $newWheelsCuType;
    }

    public function testTypeWheelsCuTypeIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testTypeWheelsCuTypeIsUniqueNoOk()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setType('cuName1type1'))->count());
    }

    public function testRefWheelsCuTypeIsEmpty()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setType(''))->count());
    }

    public function testStockMiniWheelsCuTypeIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setStockMini(-1))->count());
    }

    public function testStockRealWheelsCuTypeIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setStockReal(-1))->count());
    }

    public function testAdditionStockWheelsCuForStockRealInWheelsCuType()
    {
        $wheelsCuType = $this->manager->getRepository(WheelsCuType::class)->findOneBy(['type' => 'cuName1type1']);

        $stockExpected = 0;

        foreach ($wheelsCuType->getWheelsCus() as $wheels) {
            $stockExpected += $wheels->getStock();
        }

        $this->assertEquals($stockExpected, $wheelsCuType->getStockReal());
    }

    public function testTotalNotDeliveredRealWheelsCuTypeIsNegative()
    {
        $this->assertSame(1, $this->validator->validate($this->create()->setTotalNotDelivered(-1))->count());
    }

    public function testAdditionTotalNotDeliveredWheelsCuForStockRealInWheelsCuType()
    {
        $wheelsCuType = $this->manager->getRepository(WheelsCuType::class)->findOneBy(['type' => 'cuName1type1']);

        $totalNotDeliveredExpected = 0;

        foreach ($wheelsCuType->getWheelsCus() as $wheels) {
            $totalNotDeliveredExpected += $wheels->getNotDelivered();
        }

        $this->assertEquals($totalNotDeliveredExpected, $wheelsCuType->getTotalNotDelivered());
    }
}
