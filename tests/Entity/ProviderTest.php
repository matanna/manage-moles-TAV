<?php

namespace App\Tests\Entity;

use App\Entity\Provider;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProviderTest extends KernelTestCase
{
    use EntityTestTrait;

    public function testNameProviderIsUniqueOk()
    {
        $provider = new Provider();
        $provider->setName('provider8');

        $this->assertSame(0, $this->validator->validate($provider)->count());
    }

    public function testNameProviderIsUniqueNoOk()
    {
        $provider = new Provider();
        $provider->setName('provider1');
        
        $this->assertEquals(1, $this->validator->validate($provider)->count());
    }
}