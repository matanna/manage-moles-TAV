<?php

namespace App\Controller;

use App\Entity\RectiMachineConsumption;
use App\Form\RectiMachineConsumptionFormType;
use App\Repository\PositionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WheelsRectiMachineRepository;
use App\Form\ChoicePositionOfRectiMachineFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
           
            $wheelsTable = [];

            foreach ($wheels as $eachWheels) {

                $consumption = new RectiMachineConsumption();

                $form = $this->get('form.factory')->createNamed('form-consumption-' . $eachWheels->getId(), RectiMachineConsumptionFormType::class, $consumption, [
                    'action' => $this->generateUrl('update_stock_rectiMachine_submit', ['wheelsId' => $eachWheels->getId()])
                ]);

                $wheelsTable[$eachWheels->getId()]['wheels'] = $eachWheels;

                $view = $this->render('rectiMachine/updateStockRectiMachineForm.html.twig', [
                    'consumptionForm' => $form->createView(),
                    'wheels' => $eachWheels
                ]);
                
                $wheelsTable[$eachWheels->getId()]['consumptionForm'] = $view->getContent();
            }

            return $this->json($wheelsTable, 200, [], [
                'groups' => 'wheels_by_position'
            ]);

            //return $this->json('blabla', 200);
        }
    }

    /**
     * @Route("/update/stock/rectiMachine/submit/{wheelsId}", name="update_stock_rectiMachine_submit")
     */
    public function updateStockRectiMachineSubmit(Request $request, $wheelsId): Response
    {
        $wheels = $this->wheelsRectiMachineRepository->findOneBy(['id' => $wheelsId]);

        if (!$wheels) {
            throw new NotFoundHttpException(('Cette meule n\'existe pas'));
        }

        $consumption = new RectiMachineConsumption();
        
        $form = $this->get('form.factory')->createNamed('form-consumption-' . $wheelsId, RectiMachineConsumptionFormType::class, $consumption);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {

                $consumption->setRef($wheels->getRef())
                            ->setProvider($wheels->getProvider())
                            ->setPosition($wheels->getPosition())
                ;

                $manager = $this->getDoctrine()->getManager();

                $wheels->setStock($wheels->getStock() - 1);

                $manager->persist($wheels);
                $manager->persist($consumption);

                $manager->flush();

                return $this->redirectToRoute('update_stock_rectiMachine');
            }
        }
            
    }
}
