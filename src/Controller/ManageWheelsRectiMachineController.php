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

        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $rectiMachineName = $request->get('rectiMachineName');

            $rectiMachine = $rectiMachineRepository->findOneBy(['name' => $rectiMachineName]);

            return $this->json($rectiMachine->getPositions()->toArray(), 200, [], [
                'groups' => 'rectiMachine_positions'
            ]);
        }

        //Form for add a new mole
        $newWheelsRectiMachine = new WheelsRectiMachine();
        $formNewWheelsRectiMachine = $this->createForm(WheelsRectiMachineFormType::class, $newWheelsRectiMachine);
        $formNewWheelsRectiMachine->handleRequest($request);

        if ($formNewWheelsRectiMachine->isSubmitted() && $formNewWheelsRectiMachine->isValid()) {

            $rectiMachine = $rectiMachineRepository->findOneBy(['name' => $request->request->get('wheels_rectiMachine')['rectiMachine']]);
            $position = $positionRepository->findOneBy(['name' => $request->request->get('wheels_rectiMachine')['position'], 'rectiMachine' => $rectiMachine]);
            
            $newWheelsRectiMachine->setPosition($position);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newWheelsRectiMachine);
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
            
            //For each form, we give a unique name with id of wheelsRectiMachine
            $editWheelsFormTable[$editWheels->getId()] = $this->get('form.factory')->createNamed('wheels_rectiMachine_' . $editWheels->getId(),WheelsRectiMachineFormType::class, $editWheels);
            $editWheelsFormTableView[$editWheels->getId()] = $editWheelsFormTable[$editWheels->getId()]->createView();

            $editWheelsFormTable[$editWheels->getId()]->handleRequest($request);

            if ($editWheelsFormTable[$editWheels->getId()]->isSubmitted() && $editWheelsFormTable[$editWheels->getId()]->isValid()) {
                
                $machine = $rectiMachineRepository->findOneBy(['name' => $request->request->get('meule_recti_' . $editWheels->getId())['machine']]);
                $position = $positionRepository->findOneBy(['name' => $request->request->get('meule_recti_' . $editWheels->getId())['position'], 'machine' => $machine]);
                
                $editWheels->setPosition($position);

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
