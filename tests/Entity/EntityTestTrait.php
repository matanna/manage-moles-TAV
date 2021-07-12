<?php

namespace App\Tests\Entity;

use App\DataFixtures\CuFixtures;
use App\DataFixtures\ProviderFixtures;
use App\DataFixtures\CuCategoriesFixtures;
use App\DataFixtures\RectiMachineFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\WheelsRectiMachineFixtures;

trait EntityTestTrait
{
    protected $manager;

    protected $validator;
    
    use FixturesTrait;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->loadFixtures([
            CuFixtures::class, 
            CuCategoriesFixtures::class,
            ProviderFixtures::class,
            RectiMachineFixtures::class,
            WheelsRectiMachineFixtures::class,
            
        ]);
    
        $this->manager = self::$container->get('doctrine')->getManager();

        $this->validator = self::$container->get('validator');
    }
}