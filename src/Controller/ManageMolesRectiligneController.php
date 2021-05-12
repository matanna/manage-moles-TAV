<?php

namespace App\Controller;

use App\Entity\MeulesRecti;
use App\Form\MeulesRectiType;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use App\Repository\MeulesRectiRepository;
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

        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $machineName = $request->get('machineName');

            $machine = $machineRepository->findOneBy(['name' => $machineName]);

            return $this->json($machine->getPositions()->toArray(), 200, [], [
                'groups' => 'machine_positions'
            ]);
        }

        //Form for add a new mole
        $newMeuleRecti = new MeulesRecti();
        $formNewMeule = $this->createForm(MeulesRectiType::class, $newMeuleRecti);
        $formNewMeule->handleRequest($request);

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
        $editMeulesRecti = $meulesRectiRepository->findAll();
        //Initialize array for all forms for edit MeulesRecti
        $editMeulesFormTable = [];
        //Initialize array for all formsView for edit MeulesRecti
        $editMeulesFormTableView = [];

        foreach ($editMeulesRecti as $editMeule) {
            
            //For each form, we give a unique name with id of MeuleRecti
            $editMeulesFormTable[$editMeule->getId()] = $this->get('form.factory')->createNamed('meule_recti_' . $editMeule->getId(),MeulesRectiType::class, $editMeule);
            $editMeulesFormTableView[$editMeule->getId()] = $editMeulesFormTable[$editMeule->getId()]->createView();

            $editMeulesFormTable[$editMeule->getId()]->handleRequest($request);

            if ($editMeulesFormTable[$editMeule->getId()]->isSubmitted() && $editMeulesFormTable[$editMeule->getId()]->isValid()) {
                
                $machine = $machineRepository->findOneBy(['name' => $request->request->get('meule_recti_' . $editMeule->getId())['machine']]);
                $position = $positionRepository->findOneBy(['name' => $request->request->get('meule_recti_' . $editMeule->getId())['position'], 'machine' => $machine]);
                
                $editMeule->setPosition($position);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($editMeule);
                $manager->flush();
                
                return $this->redirectToRoute('manage_moles_rectiligne');
            }
        }

        $meulesRecti = $meulesRectiRepository->findAllMeulesRecti($param);

        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'formNewMeule' => $formNewMeule->createView(),
            'formEditMeuleTable' => $editMeulesFormTableView,
            'meulesRecti' => $meulesRecti
        ]);
    }

    /**
     * @Route("delete/mole/{id}", name="delete_mole")
     */
    public function deleteMole(MeulesRectiRepository $meulesRectiRepository, $id)
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        $meuleRecti = $meulesRectiRepository->find($id);

        if ($meuleRecti) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($meuleRecti);
            $manager->flush();
        }

        return $this->redirectToRoute('manage_moles_rectiligne');
    }
}
