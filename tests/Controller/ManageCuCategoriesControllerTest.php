<?php

namespace App\Tests\Controller;

use App\Tests\Controller\ControllerTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ManageCuCategoriesControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testAddNewCategoryAjaxRequest(): void
    {
        $this->loginSuperUser();

        $this->client->request('POST', "/manage/edit/cu/cuName1", [
            'cuCategoryName' => 'categoryTest'
        ]);

        dd($this->client->getResponse());

        
    }
}
