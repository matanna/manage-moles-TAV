<?php

namespace App\DataFixtures;

use App\Entity\Cu;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for ($i = 0; $i < 6; $i++) {
           
           $cu = new Cu();

           $cu->setName('cuName'.$i);

           $manager->persist($cu);
           $manager->flush();
       }
    }
}
