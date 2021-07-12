<?php

namespace App\DataFixtures;

use App\Entity\CuCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CuCategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for ($i = 0; $i < 6; $i++) {
           
           $category = new CuCategories();

           $category->setName('category'.$i);

           $manager->persist($category);
           $manager->flush();
       }
    }
}
