<?php

namespace App\Controller;

use App\Entity\RectiMachine;
use App\Form\RectiMachineFormType;
use App\Repository\RectiMachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WheelsRectiMachineRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageRectiMachineController extends AbstractController
{
    /**
     * @Route("/manage/rectiMachine", name="manage_rectiMachine")
     */
    public function manageRectiMachine(Request $request, EntityManagerInterface $manager,
        RectiMachineRepository $rectiMachineRepository
    ): Response {
        $rectiMachine = new RectiMachine();

        $form = $this->createForm(RectiMachineFormType::class, $rectiMachine);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($rectiMachine);
            $manager->flush();

            return $this->redirectToRoute('manage_rectiMachine');
        }

        $rectiMachines = $rectiMachineRepository->findAll();

        return $this->render('manage-machines/manageRectiMachine.html.twig', [
            'form' => $form->createView(),
            'rectiMachines' => $rectiMachines
        ]);
    }

    /**
     * @Route("/manage/rectiMachine/{nameRectiMachine}/change-name", name="change_name_rectiMachine")
     */
    public function renameRectiMachine(RectiMachineRepository $rectiMachineRepository,
        EntityManagerInterface $manager, $nameRectiMachine
    ) : Response {
        $rectiMachine = $rectiMachineRepository->findOneBy(['name' => $nameRectiMachine]);

        if (!$rectiMachine) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();

        if ($data && $data["newRectiMachineName"] != NULL) {
            
            $rectiMachine->setName($data["newRectiMachineName"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($rectiMachine);
            $manager->flush();

        }

        return $this->redirectToRoute('edit_rectiMachine', [
            'nameRectiMachine' => $data["newRectiMachineName"]
        ]);

    }

    /**
     * @Route("/manage/delete/rectiMachine/{id}", name="delete_rectiMachine")
     */
    public function deleteRectiMachine(RectiMachineRepository $rectiMachineRepository,
        EntityManagerInterface $manager, WheelsRectiMachineRepository $wheelsRectiMachineRepository, $id
    ) {
        $rectiMachine = $rectiMachineRepository->findOneBy(['id' => $id]);  
        
        if (!$rectiMachine) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $wheelsRectiMachine = $wheelsRectiMachineRepository->findAllOrderByPosition($rectiMachine->getName());

        if ($rectiMachine && $wheelsRectiMachine  == NULL) {
            $manager->remove($rectiMachine);
            $manager->flush();
        } else {
            $message = $this->addFlash('warning', 'Des meules sont liées à cette machine, la suppression est impossible.'); 
        }

        return $this->redirectToRoute('manage_rectiMachine');
    }

}
