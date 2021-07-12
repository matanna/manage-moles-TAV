<?php

namespace App\DataFixtures;

use App\Entity\Position;
use App\Entity\RectiMachine;
use App\Entity\WheelsRectiMachine;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class WheelsRectiMachineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rectiMachine = $manager->getRepository(RectiMachine::class)->findOneBy(['id' => 1]);
        
        $position = new Position();
        $position->setName('position')
                 ->setType('type')
                 ->setStockMini(4)
                 ->setRectiMachine($rectiMachine);
        $manager->persist($position);
    
        for ($i = 0; $i < 6; $i++) {
           
           $wheelsRectiMachine = new WheelsRectiMachine();

           //We add only not nullable parameters - nullables are not tested
           $wheelsRectiMachine->setRef('Ref'.$i)            
                              ->setTAVname('TAVname'.$i)
                              ->setDiameter(150 + $i)
                              ->setStock($i)
                              ->setNotDelivered($i)
                              ->setPosition($position);

           $manager->persist($wheelsRectiMachine);
           $manager->flush();
       }
    }
}