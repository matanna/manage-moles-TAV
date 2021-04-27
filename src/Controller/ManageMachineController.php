<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManageMachineController extends AbstractController
{
    /**
     * @Route("/manage/machine", name="manage_machine")
     */
    public function manageMachine(): Response
    {
        return $this->render('updateDatabase/manageMachine.html.twig', [
            'controller_name' => 'ManageMachineController',
        ]);
    }
}
