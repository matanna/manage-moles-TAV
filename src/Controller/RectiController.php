<?php

namespace App\Controller;

use App\Repository\MachineRepository;
use App\Events\MeulesRectiChangeEvent;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RectiController extends AbstractController
{
    /**
     * @Route("/rectiligne/{name}", name="rectiligne")
     */
    public function stockBilat(MeulesRectiRepository $meulesRectiRepository,
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
    public function updateQuantityMeule(MeulesRectiRepository $meulesRectiRepository,
       $id, $nameMachine, EventDispatcherInterface $dispatcher
    ) : Response {

        $meule = $meulesRectiRepository->findOneBy(['id' => $id]);

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();
        
        if ($data && $data["quantity"] != NULL) {
            
            $meule->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($meule);
            $manager->flush();

            //We launch the event for update stock in position table
            $event = new MeulesRectiChangeEvent($meule, $nameMachine);
            $dispatcher->dispatch($event, MeulesRectiChangeEvent::NAME);
        }

        return $this->redirectToRoute("rectiligne", [
            'name' => $nameMachine
        ]);
    }
}
