<?php

namespace App\Tests\Entity;

use App\Entity\CuCategories;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CuCategoriesTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $newCategory = new CuCategories();
        $newCategory->setName('category8');

        return $newCategory;
    }

    public function testNameCuCategoriesIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testNameCuCategoriesIsUniqueNoOk()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('category1'))->count());
    }

    public function testNameCuCategoriesIsEmpty()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName(''))->count());
    }

    public function testNameCuCategoriesIsOneChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('a'))->count());
    }

    public function testNameCuCategoriesIsTwentySixChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('abcdefghijqlmnopqrstuvwxyz'))->count());
    }
}