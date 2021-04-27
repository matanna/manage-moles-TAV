<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageMachineController extends AbstractController
{
    /**
     * @Route("/manage/machine", name="manage_machine")
     */
    public function manageMachine(Request $request): Response
    {
        $machine = new Machine();

        $form = $this->createForm(MachineType::class, $machine);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($machine);
        }

        return $this->render('updateDatabase/manageMachine.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
