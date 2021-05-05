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
        
        $formNewMeule->handleRequest($request);

        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $machineName = $request->get('machineName');

            $machine = $machineRepository->findBy(['name' => $machineName]);

            return $this->json($machine[0]->getPositions()->toArray(), 200, [], [
                'groups' => 'machine_positions'
            ]);
        }

        if ($formNewMeule->isSubmitted() && $formNewMeule->isValid()) {

            $machine = $machineRepository->findBy(['name' => $request->request->get('machine')]);
            $position = $positionRepository->findBy(['name' => $request->request->get('position'), 'machine' => $machine]);
            //$manager->persist($newMeuleRecti);
            //$manager->flush();
            dump($position);
            return $this->redirectToRoute('manage_moles_rectiligne');
        }

        $meulesRecti = $meulesRectiRepository->findAllMeulesRecti($param);


        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'formNewMeule' => $formNewMeule->createView(),
            'meulesRecti' => $meulesRecti
        ]);
    }
}
