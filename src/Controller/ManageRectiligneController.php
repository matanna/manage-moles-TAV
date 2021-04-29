<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use App\Form\PositionType;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageRectiligneController extends AbstractController
{
    /**
     * @Route("/manage/rectiligne", name="manage_rectiligne")
     */
    public function manageRectiligne(Request $request, EntityManagerInterface $manager,
        PositionRepository $positionRepository, MachineRepository $machineRepository
    ): Response {
        $machine = new Machine();

        $form = $this->createForm(MachineType::class, $machine);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($machine);
            $manager->flush();

            return $this->redirectToRoute('manage_rectiligne');
        }

        $positions = $positionRepository->findAll();
        $machines = $machineRepository->findAll();

        return $this->render('updateDatabase/manageRectiligne.html.twig', [
            'form' => $form->createView(),
            'positions' => $positions,
            'machines' => $machines
        ]);
    }

    /**
     * @Route("/delete/{nameMachine}", name="delete_rectiligne")
     */
    public function deleteRectiligne()
    {

    }

    /**
     * @Route("/edit/{nameMachine}", name="edit_rectiligne")
     */
    public function editRectiligne(PositionRepository $positionRepository, 
        $nameMachine, Request $request, EntityManagerInterface $manager
    ) {
        $positions = $positionRepository->findPositionByMachine($nameMachine);

        $formPositionViewTable = [];

        $idPosition = (int)$request->get('position-id');

        foreach ($positions as $position) {
            
            $formPositionType= $this->createForm(PositionType::class, $position);
            $formPositionViewTable[] = $formPositionType->createView();

            $formPositionType->handleRequest($request);
            
            if ($formPositionType->isSubmitted() && $formPositionType->isValid() && $position->getId() === $idPosition) {
                
                $manager->persist($position);
                //$manager->flush();
               
                return $this->redirectToRoute('edit_rectiligne', [
                    'nameMachine' => $nameMachine
                ]);
            }
        }


        return $this->render('updateDatabase/editRectiligne.html.twig', [
            'nameMachine' => $nameMachine,
            'positions' => $positions,
            'formPositionTable' => $formPositionViewTable
        ]);
    }

}
