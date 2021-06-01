<?php

namespace App\Controller;

use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RectiligneController extends AbstractController
{
    /**
     * @Route("/rectilignes", name="rectilignes")
     */
    public function stockAllRectiligne(MeulesRectiRepository $meulesRectiRepository,
    PositionRepository $positionRepository, MachineRepository $machineRepository)
    {
        $machines = $machineRepository->findAll();

        return $this->render('rectiligne/all-machines.html.twig', [
            'machines' => $machines
        ]);
    }

    /**
     * @Route("/rectiligne/{name}", name="rectiligne")
     */
    public function stockRectiligne(MeulesRectiRepository $meulesRectiRepository,
        PositionRepository $positionRepository, $name
    ): Response {

        $stockBilat = $meulesRectiRepository->findAllOrderByPosition($name);

        $positionTable = $positionRepository->findPositionByMachine($name);

        return $this->render('rectiligne/machine.html.twig', [
            "stockBilat" => $stockBilat,
            "positionTable" => $positionTable,
            "nameMachine" => $name
        ]);
    }

    /**
     * @Route("/rectiligne/{nameMachine}/change-quantity/{id}", name="recti-meule-change-quantity")
     */
    public function updateQuantityRectiMole(MeulesRectiRepository $meulesRectiRepository,
       $id, $nameMachine
    ) : Response {

        $meule = $meulesRectiRepository->findOneBy(['id' => $id]);

        if (!$meule) {
            throw new NotFoundHttpException('Cette page n\'existe pas');
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();
        
        if ($data && $data["quantity"] != NULL) {
            
            $meule->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($meule);
            $manager->flush();

        }

        return $this->redirectToRoute("rectiligne", [
            'name' => $nameMachine
        ]);
    }
}
