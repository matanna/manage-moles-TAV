<?php

namespace App\Tests\Controller;

use App\DataFixtures\CuFixtures;
use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
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
        
        $this->client->request('GET', '/all-rectiMachines');

        $this->loadFixtures(
            [ 
            CuCategoriesFixtures::class,
            ProviderFixtures::class,
            CuFixtures::class,
            RectiMachineFixtures::class,
            UserFixtures::class
            ]
        );
    }

    protected function loginAdmin()
    {   
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
        
        $this->client->request(
            'POST', '/login', [
                'username' => 'admin',
                'password' => 'admin',
                'roles' => ['ROLE_ADMIN'],
                'csrf_token' => $csrfToken
            ]
        );
        
    }

    protected function loginSuperUser()
    {
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');

        $this->client->request(
            'POST', '/login', [
                'username' => 'superUser',
                'roles' => ['ROLE_SUPER_USER'],
                'password' => 'superUser',
                '_csrf_token' => $csrfToken
            ]
        );
    }

    protected function loginUser()
    {
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
       
        $this->client->request(
            'POST', '/login', [   
                'username' => 'user',
                'password' => 'user',
                '_csrf_token' => $csrfToken                
            ]
        );
    }

}