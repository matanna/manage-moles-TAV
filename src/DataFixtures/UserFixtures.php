<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = (new User())
                     ->setUsername('admin')
                     ->setPassword('$2y$10$apqI.yOdJtkwzHs7OYdJ9OY7SOGnjwaIC0.zgXh/NRi9/KiLMpGXW')
                     ->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);

        $superUser = (new User())
                     ->setUsername('superUser')
                     ->setPassword('$2y$10$prDivxvkiCuA1u81tl5yJejjZbFScEIlGMc/Xu52Kzem1L1uviK4W')
                     ->setRoles(['ROLE_SUPER_USER']);

        $manager->persist($superUser);
        
        $user = (new User())
                     ->setUsername('user')
                     ->setPassword('$2y$10$jnnx79Dfs463bYv8fFuNBeMO/LEzaWBoPsJrCrza/5Ce11uhEU0ca');

        $manager->persist($user);

        $manager->flush();
    }
}
