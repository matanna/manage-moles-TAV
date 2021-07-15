<?php

namespace App\Tests\Controller;

use App\DataFixtures\CuFixtures;
use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use App\Tests\Entity\EntityTestTrait;
use App\DataFixtures\ProviderFixtures;
use App\DataFixtures\CuCategoriesFixtures;
use App\DataFixtures\RectiMachineFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;

trait ControllerTestTrait
{
    use FixturesTrait;

    protected $client;

    protected function setUp(): void
    {
        $this->client = $client = static::createClient();

        $this->loadFixtures([ 
            CuCategoriesFixtures::class,
            ProviderFixtures::class,
            CuFixtures::class,
            RectiMachineFixtures::class,
            UserFixtures::class
        ]);
    }

    protected function loginAdmin()
    {
        $userAdmin = static::$container->get(UserRepository::class)->findOneBy(['username' => 'admin']);
        
        return $this->client->loginUser($userAdmin);
    }

    protected function loginSuperUser()
    {
        $superUser = static::$container->get(UserRepository::class)->findOneBy(['username' => 'superUser']);
        
        return $this->client->loginUser($superUser);
    }

    protected function loginUser()
    {
        $user = static::$container->get(UserRepository::class)->findOneBy(['username' => 'user']);
        
        return $this->client->loginUser($user);
    }

}