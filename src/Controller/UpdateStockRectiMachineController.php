<?php

namespace App\Controller;

use App\Repository\PositionRepository;
use App\Repository\RectiMachineRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WheelsRectiMachineRepository;
use App\Form\ChoicePositionOfRectiMachineFormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateStockRectiMachineController extends AbstractController
{
    private $positionRepository;

    private $wheelsRectiMachineRepository;

    public function __construct(PositionRepository $positionRepository, 
        WheelsRectiMachineRepository $wheelsRectiMachineRepository
    ) {
        $this->positionRepository = $positionRepository;
        $this->wheelsRectiMachineRepository = $wheelsRectiMachineRepository;
    }

    /**
     * @Route("/update/stock/rectiMachine", name="update_stock_rectiMachine")
     */
    public function updateStockRectiMachine(Request $request): Response
    {
        $positions = null;
        
        //Ajax request for adapt positions in terms of machine
        if ($request->isXmlHttpRequest()) {

            $rectiMachineName = $request->get('rectiMachineName');

            $positions = $this->positionRepository->findPositionByRectiMachine($rectiMachineName);

            $formWheelsRectiMachine = $this->createForm(ChoicePositionOfRectiMachineFormType::class, null, [
                'positions' => $positions
            ]);
            
            //We create view for the form and render it in a twig template. this template is send with ajax for updated positions
            $view = $this->render('manage_wheels/manageWheelsRectiMachineAjax.html.twig', [
                'formNewWheelsRectiMachine' => $formWheelsRectiMachine->createView() 
            ]);
            
            return $this->json($view, 200);
        }

        $choicePositionOfRectiMachineForm = $this->createForm(ChoicePositionOfRectiMachineFormType::class, null, [
            'positions' => $positions
        ]);

        return $this->render('rectiMachine/updateStockRectiMachine.html.twig', [
            'choicePositionOfRectiMachineForm' => $choicePositionOfRectiMachineForm->createView()
         ]);
    }

    /**
     * @Route("/update/stock/rectiMachine/wheels", name="update_stock_rectiMachine_wheels")
     */
    public function updateStockRectiMachineWheels(Request $request): Response
    {
        //Ajax request for display wheels in terms of position and machine
        if ($request->isXmlHttpRequest()) {


            $wheels = $this->wheelsRectiMachineRepository->findWheelsRectiMachineByPosition(
                $request->get('rectiMachineName'),
                $request->get('positionName')
            );

            return $this->json($wheels, 200, [], [
                'groups' => 'wheels_by_position'
            ]);
        }
    }
}
