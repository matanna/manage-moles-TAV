<?php

namespace App\DataFixtures;

use App\Entity\Provider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProviderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for ($i = 0; $i < 6; $i++) {
           
           $provider = new Provider();

           $provider->setName('provider'.$i);

           $manager->persist($provider);
           $manager->flush();
       }
    }
}