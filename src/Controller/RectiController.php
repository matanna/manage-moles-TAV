<?php

namespace App\Controller;

use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RectiController extends AbstractController
{
    /**
     * @Route("/rectiligne/{name}", name="rectiligne")
     */
    public function stockBilat(MeulesRectiRepository $meulesRectiRepository,
        PositionRepository $positionRepository, $name, Request $request
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
     * @Route("/rectiligne/{name}/change-quantity/{id}", name="recti-meule-change-quantity")
     */
    public function updateQuantityMeule(MeulesRectiRepository $meulesRectiRepository,
        Request $request, $id, $name
    ) : Response {

        $meule = $meulesRectiRepository->findOneBy(['id' => $id]);

        $data = $request->request->all();
        

        if ($data && $data["quantity"] != NULL) {
            
            $meule->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($meule);
            $manager->flush();
        }

        return $this->redirectToRoute("rectiligne", [
            'name' => $name
        ]);
    }
}
