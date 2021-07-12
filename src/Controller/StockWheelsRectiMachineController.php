<?php

namespace App\Controller;

use App\Repository\RectiMachineRepository;
use App\Repository\PositionRepository;
use App\Repository\WheelsRectiMachineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockWheelsRectiMachineController extends AbstractController
{
    /**
     * @Route("/all-rectiMachines", name="rectiMachines")
     */
    public function stockAllWheelsRectiMachines(RectiMachineRepository $rectiMachineRepository)
    {
        $rectiMachines = $rectiMachineRepository->findAll();

        return $this->render('rectiMachine/all-rectiMachines.html.twig', [
            'rectiMachines' => $rectiMachines
        ]);
    }

    /**
     * @Route("/rectiMachine/{name}", name="rectiMachine")
     */
    public function stockWheelsRectiMachine(WheelsRectiMachineRepository $wheelsRectiMachineRepository,
        PositionRepository $positionRepository, $name
    ): Response {

        $stockWheelsRectiMachine = $wheelsRectiMachineRepository->findAllOrderByPosition($name);

        $positionTable = $positionRepository->findPositionByRectiMachine($name);

        return $this->render('rectiMachine/rectiMachine.html.twig', [
            "stockWheelsRectiMachine" => $stockWheelsRectiMachine,
            "positionTable" => $positionTable,
            "nameRectiMachine" => $name
        ]);
    }

    /**
     * @Route("/rectiMachine/{nameRectiMachine}/change-quantity/{id}", name="rectiMachine-wheels-change-quantity")
     */
    public function updateQuantityWheelsRectiMachine(WheelsRectiMachineRepository $wheelsRectiMachineRepository,
       $id, $nameRectiMachine
    ) : Response {

        $wheels = $wheelsRectiMachineRepository->findOneBy(['id' => $id]);

        if (!$wheels) {
            throw new NotFoundHttpException('Cette page n\'existe pas');
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();
        
        if ($data && $data["quantity"] != NULL) {
            
            $wheels->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($wheels);
            $manager->flush();

        }

        return $this->redirectToRoute("rectiMachine", [
            'name' => $nameRectiMachine
        ]);
    }
}
