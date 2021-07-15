<?php

namespace App\DataFixtures;

use App\Entity\Cu;
use App\Entity\User;
use App\Entity\Provider;
use App\Entity\WheelsCu;
use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = (new User())
                     ->setUsername('admin')
                     ->setPassword('admin');

        $manager->persist($userAdmin);

        $superUser = (new User())
                     ->setUsername('superUser')
                     ->setPassword('superUser');

        $manager->persist($superUser);
        
        $user = (new User())
                     ->setUsername('user')
                     ->setPassword('user');

        $manager->persist($user);

        $manager->flush();
    }
}
