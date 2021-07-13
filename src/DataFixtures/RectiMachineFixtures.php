<?php

namespace App\DataFixtures;

use App\Entity\RectiMachine;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RectiMachineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for ($i = 0; $i < 6; $i++) {
           
           $rectiMachine = new RectiMachine();

           $rectiMachine->setName('RectiMachineName'.$i);

           $manager->persist($rectiMachine);
           $manager->flush();
       }
    }
}
