<?php

namespace App\Tests\Entity;

use App\Entity\Provider;
use App\Tests\Entity\EntityTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProviderTest extends KernelTestCase
{
    use EntityTestTrait;

    private function create()
    {
        $provider = new Provider();
        $provider->setName('provider8');

        return $provider;
    }

    public function testNameProviderIsUniqueOk()
    {
        $this->assertSame(0, $this->validator->validate($this->create())->count());
    }

    public function testNameProviderIsUniqueNoOk()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('provider1'))->count());
    }

    public function testNameProviderIsEmpty()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName(''))->count());
    }

    public function testNameProviderIsOneChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('a'))->count());
    }

     public function testNameProviderIsTwentyOneChar()
    {
        $this->assertEquals(1, $this->validator->validate($this->create()->setName('abcdefghijqlmnopqrstu'))->count());
    }
}