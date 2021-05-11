<?php

namespace App\Controller;

use App\Entity\MeulesRecti;
use App\Form\MeulesRectiType;
use Symfony\Component\Form\Forms;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
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

        $editMeulesRecti = $meulesRectiRepository->findAll();

        //Form for edit moles
        $editMeulesFormTable = [];
        $editMeulesFormTableView = [];

        foreach ($editMeulesRecti as $editMeule) {
            $editMeulesFormTable[$editMeule->getId()] = $this->createForm(MeulesRectiType::class, $editMeule);
            $editMeulesFormTableView[$editMeule->getId()] = $editMeulesFormTable[$editMeule->getId()]->createView();

            if ($editMeulesFormTable[$editMeule->getId()]->isSubmitted() && $editMeulesFormTable[$editMeule->getId()]->isValid()) {

                $machine = $machineRepository->findOneBy(['name' => $request->request->get('meules_recti')['machine']]);
                $position = $positionRepository->findOneBy(['name' => $request->request->get('meules_recti')['position'], 'machine' => $machine]);
                
                $editMeule->setPosition($position);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($editMeule);
                $manager->flush();
                
                return $this->redirectToRoute('manage_moles_rectiligne');
            }
        }

        if ($formNewMeule->isSubmitted() && $formNewMeule->isValid()) {

            $machine = $machineRepository->findOneBy(['name' => $request->request->get('meules_recti')['machine']]);
            $position = $positionRepository->findOneBy(['name' => $request->request->get('meules_recti')['position'], 'machine' => $machine]);
            
            $newMeuleRecti->setPosition($position);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newMeuleRecti);
            $manager->flush();
            
            return $this->redirectToRoute('manage_moles_rectiligne');
        }

        $meulesRecti = $meulesRectiRepository->findAllMeulesRecti($param);


        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'formNewMeule' => $formNewMeule->createView(),
            'formEditMeuleTable' => $editMeulesFormTableView,
            'meulesRecti' => $meulesRecti
        ]);
    }
}
