<?php

namespace App\DataFixtures;

use App\Entity\User;
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
       for ($i = 0; $i < 6; $i++) {
           
            $user = new User();

            $string = 'abcdefghijklmnopqrstuvwABCDEFGHIJKLMNOPUVWXY0123456789';
            $length = strlen($string);

            $username = '';

            for ($j = 0; $j < rand(4, 10); $j++) {
                
                $username .= $string[rand(0, $length)];
            }

            $user->setUsername($username);

            $user->setPassword('password');

            $manager->persist($user);
            $manager->flush();
       }
    }
}
