<?php

namespace App\DataFixtures;

use App\Entity\Position;
use App\Entity\RectiMachine;
use App\Entity\WheelsRectiMachine;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RectiMachineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for ($i = 0; $i < 6; $i++) {
           
           $rectiMachine = (new RectiMachine())->setName('RectiMachineName'.$i);

           $manager->persist($rectiMachine);

           for ($j = 0; $j < 6; $j++) {

                $position = (new Position())
                            ->setName('RectiMachineName'.$i.'position'.$j)
                            ->setStockMini($j)
                            ->setStockReal($j)
                            ->setTotalNotDelivered($j)
                            ->setRectiMachine($rectiMachine);

                $manager->persist($position);

                for ($k = 0; $k < 6; $k++) {

                    $wheelsRectiMachine = (new WheelsRectiMachine())
                                          ->setRef('RectiMachineName'.$i.'position'.$j.'wheels'.$k)
                                          ->setDiameter(150 + $k)
                                          ->setTAVname('wheels'.$k)
                                          ->setStock($k)
                                          ->setNotDelivered($k)
                                          ->setPosition($position);
                    
                    $manager->persist($wheelsRectiMachine);
                }
           }
       }

       $manager->flush();
    }
}
