<?php

namespace App\Controller;

use App\Entity\MeulesRecti;
use App\Form\MeulesRectiType;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageMolesRectiligneController extends AbstractController
{
    /**
     * @Route("/manage/moles-rectiligne", name="manage_moles_rectiligne")
     * @Route("/manage/moles-rectiligne/{param}", name="manage_moles_rectiligne_try")
     */
    public function manageMolesRectiligne(MeulesRectiRepository $meulesRectiRepository,
        MachineRepository $machineRepository, PositionRepository $positionRepository, $param = null
    ): Response {

        $request = $this->get('request_stack')->getCurrentRequest();

        $newMeuleRecti = new MeulesRecti();
        $formNewMeule = $this->createForm(MeulesRectiType::class, $newMeuleRecti);

        $editMeulesRecti = $meulesRectiRepository->findAll();
        $formEditMeule = $this->createForm(MeulesRectiType::class, $editMeulesRecti);
        
        $formNewMeule->handleRequest($request);

        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $machineName = $request->get('machineName');

            $machine = $machineRepository->findOneBy(['name' => $machineName]);

            return $this->json($machine->getPositions()->toArray(), 200, [], [
                'groups' => 'machine_positions'
            ]);
        }

        //Form for add a new mole
        if ($formNewMeule->isSubmitted() && $formNewMeule->isValid()) {

            $machine = $machineRepository->findOneBy(['name' => $request->request->get('meules_recti')['machine']]);
            $position = $positionRepository->findOneBy(['name' => $request->request->get('meules_recti')['position'], 'machine' => $machine]);
            
            $newMeuleRecti->setPosition($position);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newMeuleRecti);
            $manager->flush();
            
            return $this->redirectToRoute('manage_moles_rectiligne');
        }

        //Form for edit moles
        if ($formEditMeule->isSubmitted() && $formEditMeule->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newMeuleRecti);
            $manager->flush();
            
            return $this->redirectToRoute('manage_moles_rectiligne');
        }

        $meulesRecti = $meulesRectiRepository->findAllMeulesRecti($param);


        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'formNewMeule' => $formNewMeule->createView(),
            'formEditMeule' => $formEditMeule->createView(),
            'meulesRecti' => $meulesRecti
        ]);
    }
}
