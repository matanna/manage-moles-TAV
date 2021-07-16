<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Controller\ControllerTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testSuccessfulLogin(): void
    {
        $this->loginUser();
        $this->assertResponseStatusCodeSame(302, $this->client->getResponse()->getStatusCode());
    
        $crawler = $this->client->followRedirect();
        
        //We log a user when we are on the stock rectiMachine page - We are redirect on this page after login
        $this->assertPageTitleSame('Stock des rectilignes', $crawler->filter('title')->text());

        $user = self::$container->get(UserRepository::class)->findOneBy(['username' => 'user']);

        //We check if the user is login
        $this->assertSame($user, self::$container->get('security.token_storage')->getToken()->getUser());

    }

    public function testBadCredentialsLogin(): void
    {
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
       
        $crawler = $this->client->request(
            'POST', '/login', [   
                'username' => 'user',
                'password' => 'baduser',
                '_csrf_token' => $csrfToken                
            ]
        );
        $this->assertResponseStatusCodeSame(302, $this->client->getResponse()->getStatusCode());

        //We check this is no user login
        $this->assertSame(null, self::$container->get('security.token_storage')->getToken());

    }

    public function testLogout(): void
    {
        $this->loginUser();

        $this->client->request('GET', '/logout');

        $this->assertResponseStatusCodeSame(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();
        
        //We unlog a user when we are on the stock rectiMachine page - We are redirect on the home page after logout
        $this->assertPageTitleSame('Gestion des meules - Accueil', $crawler->filter('title')->text());

        //We check this is no user login
        $this->assertSame(null, self::$container->get('security.token_storage')->getToken());
    }
}