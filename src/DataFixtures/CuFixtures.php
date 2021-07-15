<?php

namespace App\DataFixtures;

use App\Entity\Cu;
use App\Entity\Provider;
use App\Entity\WheelsCu;
use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
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
           

            for ($j = 0; $j < 6; $j++) {

                $category = $manager->getRepository(CuCategories::class)->findOneBy(['id' => rand(1, 6)]);

                $wheelsCuType = (new WheelsCuType())
                                ->setType('cuName'.$i . 'type'.$j)
                                ->setStockMini($j)
                                ->setStockReal($j)
                                ->setCu($cu)
                                ->setCuCategory($category);

                $manager->persist($wheelsCuType);
                

                for ($k = 0; $k < 6; $k++) {

                    $provider = $manager->getRepository(Provider::class)->findOneBy(['id' => rand(1, 6)]);

                    $wheelsCu = (new WheelsCu())
                                ->setRef('cuName'.$i . 'type'.$j . 'Ref'.$k)
                                ->setDiameter(150+$k)
                                ->setProvider($provider)
                                ->setStock($k)
                                ->setWheelsCuType($wheelsCuType)
                                ->setNotDelivered($k);

                    $manager->persist($wheelsCu);
                    
                }
            }
            
        }

        $manager->flush();

       
    }
}
