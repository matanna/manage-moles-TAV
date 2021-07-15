<?php

namespace App\Tests\Controller;

use App\Tests\Controller\ControllerTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ManageCuCategoriesControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    private function redirectOnManageCuPageSuperUser()
    {
        $clientSuperUser = $this->loginSuperUser();

        return $clientSuperUser->request('GET', "/manage/edit/cu/cuName1");
    }

    public function testAddNewCategoryAjaxRequest(): void
    {
        

        $client = $this->redirectOnManageCuPageSuperUser();
                            /*->xmlHttpRequest(
                                "POST", 
                                "/manage/add/cuCategory", 
                                ['addNewCategory' => 'testCategory']
                            );*/

        dd($client);
    }
}
