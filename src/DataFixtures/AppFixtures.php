<?php

namespace App\DataFixtures;

use App\Entity\Machine;
use App\Entity\Position;
use App\Entity\Fournisseur;
use App\Entity\MeulesRecti;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fournisseurs = ['DIAMUT', 'ATG', 'EC GLASS', 'BOHLE'];
        $machines = ['BILATERALE', 'ROCK', 'BAUDIN'];
        $bilatPositionTable = ['1', '2', '3', '4 et 12', '5 et 13', '9', '10', '11', '6', '7', '8'];
        $rockPositionTable = ['1', '2', '3', '4', '5', '6', '7 et 9', '8 et 10'];
        $baudinPositionTable = ['1', '2', '3', '4', '5', '6 et 7', '7 et 9'];

        foreach ($machines as $machineName) {
            
            if ($machineName == 'BILATERALE') {
                $bilat = new Machine();
                $bilat->setName($machineName);
                $manager->persist($bilat); 
                        
                
                foreach ($bilatPositionTable as $positionName) {
                    $bilatPosition = new Position();
                    $bilatPosition->setName($positionName)
                                  ->setStockMini(rand(2, 8))
                                  ->setMachine($bilat);
                                  
                    $manager->persist($bilatPosition);
                    $manager->flush();
                }
            
            }

            if ($machineName == 'ROCK') {
                $rock = new Machine();
                $rock->setName($machineName);
                $manager->persist($rock); 

                
                foreach ($rockPositionTable as $positionName) {
                    $rockPosition = new Position();
                    $rockPosition->setName($positionName)
                                  ->setStockMini(rand(2, 8))
                                  ->setMachine($rock);
                                  
                    $manager->persist($rockPosition);
                    $manager->flush();
                }
             
            }

            if ($machineName == 'BAUDIN') {
                $baudin = new Machine();
                $baudin->setName($machineName);
                $manager->persist($baudin);  

                
                foreach ($baudinPositionTable as $positionName) {
                    $baudinPosition = new Position();
                    $baudinPosition->setName($positionName)
                                  ->setStockMini(rand(2, 8))
                                  ->setMachine($baudin);
                                  
                    $manager->persist($baudinPosition);
                    $manager->flush();
                }
             
            }
        }

        $machinesListObject = [$bilat, $rock, $baudin];

        foreach ($fournisseurs as $nameFournisseur) {
            $fournisseur = new Fournisseur();
            $fournisseur->setName($nameFournisseur);
            $manager->persist($fournisseur);

            for ($i=0; $i<rand(2, 20); $i++) {
                $meulesRecti = new MeulesRecti();
                $machinesListObjectKey = array_rand($machinesListObject, 1);
                $meulesRecti->setRef("Reference.$i")
                            ->setDesignationTAV("DésignationTAV.$i")
                            ->setGrain("Grain.$i")
                            ->setDiametre("150")
                            ->setHauteur("40")
                            ->setStock(rand(1,15))
                            ->addMachine($machinesListObject[$machinesListObjectKey])
                            ->setFournisseur($fournisseur);
                
                if ($machinesListObject[$machinesListObjectKey]->getName() == 'BILATERALE') {
                    $position = array_rand($bilatPositionTable);
                    $meulesRecti->setPosition([$bilatPositionTable[$position]]);
                }
                if ($machinesListObject[$machinesListObjectKey]->getName() == 'ROCK') {
                    $position = array_rand($rockPositionTable);
                    $meulesRecti->setPosition([$rockPositionTable[$position]]);
                    
                }
                if ($machinesListObject[$machinesListObjectKey]->getName() == 'BAUDIN') {
                    $position = array_rand($baudinPositionTable);
                    $meulesRecti->setPosition([$baudinPositionTable[$position]]);
                }
                $manager->persist($meulesRecti);
            }
        }
    
        $manager->flush();
    }
}
