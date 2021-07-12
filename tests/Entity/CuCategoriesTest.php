<?php

namespace App\Tests\Entity;

use App\Entity\CuCategories;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CuCategoriesTest extends KernelTestCase
{
    use EntityTestTrait;

    public function testNameCuCategoriesIsUniqueOk()
    {
        $newCategory = new CuCategories();
        $newCategory->setName('category8');
        
        $this->assertSame(0, $this->validator->validate($newCategory)->count());
    }

    public function testNameCuCategoriesIsUniqueNoOk()
    {
        $newCategory = new CuCategories();
        $newCategory->setName('category1');
        
        $this->assertEquals(1, $this->validator->validate($newCategory)->count());
    }
}