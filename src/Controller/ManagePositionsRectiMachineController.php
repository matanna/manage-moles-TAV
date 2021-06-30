<?php

namespace App\Controller;

use App\Entity\Position;
use App\Form\PositionFormType;
use App\Form\RectiMachineFormType;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RectiMachineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManagePositionsRectiMachineController extends AbstractController
{
    /**
     * @Route("/manage/edit/rectiMachine/{nameRectiMachine}", name="edit_rectiMachine")
     */
    public function editPositionRectiMachine(RectiMachineRepository $machineRepository, 
        $nameRectiMachine, EntityManagerInterface $manager
    ) : Response {
        $request = $this->get('request_stack')->getCurrentRequest();

        $rectiMachine = $machineRepository->findOneBy(['name' => $nameRectiMachine]);

        if (!$rectiMachine) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }
        
        //$formMachine is the form for edit all positions linked
        $formRectiMachine = $this->createForm(RectiMachineFormType::class, $rectiMachine);
        
        $formRectiMachine->handleRequest($request);

        if ($formRectiMachine->isSubmitted() && $formRectiMachine->isValid()) {
            
            $manager->persist($rectiMachine);
            $manager->flush();

            return $this->redirectToRoute('edit_rectiMachine', [
                'nameRectiMachine' => $nameRectiMachine
            ]);
        }

        $newPosition = new Position();

        //$formPosition is the form for add a new positions in a machine
        $formPosition = $this->createForm(PositionFormType::class, $newPosition);

        $formPosition = $formPosition->handleRequest($request);

        if ($formPosition->isSubmitted() && $formPosition->isValid()) {
            
            $newPosition->setRectiMachine($rectiMachine);
            $manager->persist($newPosition);
            $manager->flush();

            return $this->redirectToRoute('edit_rectiMachine', [
                'nameRectiMachine' => $nameRectiMachine
            ]);
        }

        return $this->render('manage-machines/editRectiMachine.html.twig', [
            'formRectiMachine' => $formRectiMachine->createView(),
            'formPosition' => $formPosition->createView(),
            'rectiMachine' => $rectiMachine
        ]);
    }

    /**
     * @Route("/manage/delete/{nameRectiMachine}/position/{id}", name="delete_position")
     */
    public function deletePosition(PositionRepository $positionRepository,
    EntityManagerInterface $manager, $id, $nameRectiMachine
    ) : Response {
        $position = $positionRepository->findOneBy(['id' => $id]);

        if ($id) {
            $manager->remove($position);
            $manager->flush();
        }

        return $this->redirectToRoute('edit_rectiMachine', [
            'nameRectiMachine' => $nameRectiMachine
        ]);
    }
}
