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
        $this->client = static::createClient();

        $this->client->request('GET', '/');

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
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('crsf_token');
        
        return $this->client->request('POST', '/login', [
            'username' => 'admin',
            'password' => 'admin',
            'csrf_token' => $csrfToken
        ]);
    }

    protected function loginSuperUser()
    {
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('crsf_token');

        return $this->client->request('POST', '/login', [
            'username' => 'superUser',
            'password' => 'superUser',
            'csrf_token' => $csrfToken
        ]);
    }

    protected function loginUser()
    {
        $user = static::$container->get(UserRepository::class)->findOneBy(['username' => 'user']);
        
        return $this->client->loginUser($user);
    }

}