<?php

namespace App\Controller;

use App\Entity\WheelsRectiMachine;
use App\Repository\PositionRepository;
use App\Form\WheelsRectiMachineFormType;
use App\Repository\RectiMachineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WheelsRectiMachineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageWheelsRectiMachineController extends AbstractController
{
    /**
     * @Route("/manage/wheels-rectiMachine", name="manage_wheels-rectiMachine")
     * @Route("/manage/wheels-rectiMachine/{param}", name="manage_wheels-rectiMachine_sort")
     */
    public function manageWheelsRectiMachine(WheelsRectiMachineRepository $wheelsRectiMachineRepository,
        RectiMachineRepository $rectiMachineRepository, PositionRepository $positionRepository, $param = null
    ): Response {

        $request = $this->get('request_stack')->getCurrentRequest();
        $wheelsRectiMachine = new WheelsRectiMachine();
        $positions = null;
        
        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $rectiMachineName = $request->get('rectiMachineName');

            $positions = $positionRepository->findPositionByRectiMachine($rectiMachineName);
            
            $formWheelsRectiMachine = $this->createForm(WheelsRectiMachineFormType::class, $wheelsRectiMachine, [
                'positions' => $positions
            ]);

            //We create view for the form and render it in a twig template. this template is send with ajax for updated positions
            $view = $this->render('manage_wheels/manageWheelsRectiMachineAjax.html.twig', [
                'formNewWheelsRectiMachine' => $formWheelsRectiMachine->createView() 
            ]);
            
            return $this->json($view, 200);
        }
        
        //Form for add a new wheels
        $formNewWheelsRectiMachine = $this->createForm(WheelsRectiMachineFormType::class, $wheelsRectiMachine, [
            'positions' => $positions
        ]);
        
        $formNewWheelsRectiMachine->handleRequest($request);

        if ($formNewWheelsRectiMachine->isSubmitted() && $formNewWheelsRectiMachine->isValid()) {
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($wheelsRectiMachine);
            $manager->flush();
            
            return $this->redirectToRoute('manage_wheels-rectiMachine');
        }

        //Form for edit wheels
        $editWheelsRectiMachine = $wheelsRectiMachineRepository->findAll();
        //Initialize array for all forms for edit MeulesRecti
        $editWheelsFormTable = [];
        //Initialize array for all formsView for edit MeulesRecti
        $editWheelsFormTableView = [];

        foreach ($editWheelsRectiMachine as $editWheels) {

            $positions = $editWheels->getPosition()->getRectiMachine()->getPositions();

            //For each form, we give a unique name with id of wheelsRectiMachine
            $editWheelsFormTable[$editWheels->getId()] = $this->get('form.factory')->createNamed(
                'wheels_rectiMachine_' . $editWheels->getId(),
                WheelsRectiMachineFormType::class, 
                $editWheels,
                [
                    "positions" => $positions
                ]
            );

            $editWheelsFormTableView[$editWheels->getId()] = $editWheelsFormTable[$editWheels->getId()]->createView();

            $editWheelsFormTable[$editWheels->getId()]->handleRequest($request);
            
            if ($editWheelsFormTable[$editWheels->getId()]->isSubmitted() && $editWheelsFormTable[$editWheels->getId()]->isValid()) {
               
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($editWheels);
                $manager->flush();
                
                return $this->redirectToRoute('manage_wheels-rectiMachine');
            }
        }

        $wheelsRectiMachines  = $wheelsRectiMachineRepository->findAllWheelsRectiMachine($param);

        return $this->render('manage_wheels/manageWheelsRectiMachine.html.twig', [
            'formNewWheelsRectiMachine' => $formNewWheelsRectiMachine->createView(),
            'formEditWheelsTable' => $editWheelsFormTableView,
            'wheelsRectiMachines' => $wheelsRectiMachines        
        ]);
    }

    /**
     * @Route("delete/wheels-rectiMachine/{id}", name="delete_wheels-rectiMachine")
     */
    public function deleteMole(WheelsRectiMachineRepository $wheelsRectiMachineRepository, $id)
    {

        $wheelsRectiMachine = $wheelsRectiMachineRepository->find($id);

        if ($wheelsRectiMachine) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($wheelsRectiMachine);
            $manager->flush();
        }

        return $this->redirectToRoute('manage_wheels-rectiMachine');
    }
}
