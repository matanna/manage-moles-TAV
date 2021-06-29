<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/manage/users", name="manage-users")
     */
    public function manageUsers(): Response
    {
        return $this->render('user/manageUsers.html.twig');
    }
}
