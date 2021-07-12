<?php

namespace App\Controller;

use App\Entity\CuConsumption;
use App\Repository\CuRepository;
use App\Form\CuConsumptionFormType;
use App\Repository\WheelsCuRepository;
use App\Repository\CuCategoriesRepository;
use App\Repository\WheelsCuTypeRepository;
use App\Form\ChoiceWheelsCuTypeOfCuFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateStockCuController extends AbstractController
{
    private $wheelsCuTypeRepository;

    private $wheelsCuRepository;

    private $cuCategoriesRepository;

    public function __construct(WheelsCuTypeRepository $wheelsCuTypeRepository,
        WheelsCuRepository $wheelsCuRepository, CuCategoriesRepository $cuCategoriesRepository
    ) {
        $this->wheelsCuTypeRepository = $wheelsCuTypeRepository;
        $this->wheelsCuRepository = $wheelsCuRepository;
        $this->cuCategoriesRepository = $cuCategoriesRepository;
    }

    /**
     * @Route("/update/stock/cu", name="update_stock_cu")
     */
    public function updateStockCu(Request $request): Response
    {

        if ($request->isXmlHttpRequest()) {

            $cuName = $request->get('cuName');
            $category = $request->get('categoryName');

            $categories = $this->cuCategoriesRepository->findCuCategoriesByCu($cuName);

            if (!$category) {
                $wheelsCuType = null;
            } else {
                $wheelsCuType = $this->wheelsCuTypeRepository->findWheelsCuTypeByCuAndByCategory($cuName, $category);
            }

            $choiceWheelsCuTypeOfCuForm = $this->createForm(ChoiceWheelsCuTypeOfCuFormType::class, null, [
                'wheelsCuType' => $wheelsCuType,
                'categories' => $categories
            ]);
            
            //We create view for the form and render it in a twig template. this template is send with ajax for updated wheelsCutype
            $view = $this->render('manage_wheels/manageWheelsCuAjax.html.twig', [
                'wheelsCuForm' => $choiceWheelsCuTypeOfCuForm->createView()
            ]);
            
            return $this->json($view, 200);
        }

        $choiceWheelsCuTypeOfCuForm = $this->createForm(ChoiceWheelsCuTypeOfCuFormType::class);

        return $this->render('cu/updateStockCu.html.twig', [
            'choiceWheelsCuTypeOfCuForm' => $choiceWheelsCuTypeOfCuForm->createView()
        ]);
    }

    /**
     * @Route("/update/stock/cu/wheels", name="update_stock_cu_wheels")
     */
    public function updateStockCuWheels(Request $request): Response
    {
        //Ajax request for display wheels in terms of wheelsCuType and cu
        if ($request->isXmlHttpRequest()) {

            $wheels = $this->wheelsCuRepository->findWheelsByType(
                $request->get('cuName'),
                $request->get('categoryName'),
                $request->get('type')
            );

            $wheelsTable = [];

            foreach ($wheels as $eachWheels) {
                
                $consumption = new CuConsumption();

                $form = $this->get('form.factory')->createNamed('form-consumption-' . $eachWheels->getId(), CuConsumptionFormType::class, $consumption, [
                    'action' => $this->generateUrl('update_stock_cu_submit', ['wheelsId' => $eachWheels->getId()])
                ]);

                $wheelsTable[$eachWheels->getId()]['wheels'] = $eachWheels;

                $view = $this->render('cu/updateStockCuForm.html.twig', [
                    'consumptionForm' => $form->createView(),
                    'wheels' => $eachWheels
                ]);
                
                $wheelsTable[$eachWheels->getId()]['consumptionForm'] = $view->getContent();
            }

            return $this->json($wheelsTable, 200, [], [
                'groups' => 'wheels_by_wheelsCuType'
            ]);
        }
    }

    /**
     * @Route("/update/stock/cu/submit/{wheelsId}", name="update_stock_cu_submit")
     */
    public function updateStockRectiMachineSubmit(Request $request, $wheelsId): Response
    {
        $wheels = $this->wheelsCuRepository->findOneBy(['id' => $wheelsId]);

        if (!$wheels) {
            throw new NotFoundHttpException(('Cette meule n\'existe pas'));
        }

        $consumption = new CuConsumption();
        
        $form = $this->get('form.factory')->createNamed('form-consumption-' . $wheelsId, CuConsumptionFormType::class, $consumption);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {

                $consumption->setRef($wheels->getRef())
                            ->setProvider($wheels->getProvider())
                            ->setWheelsCuType($wheels->getWheelsCuType())
                ;

                $manager = $this->getDoctrine()->getManager();

                $wheels->setStock($wheels->getStock() - 1);

                $manager->persist($wheels);
                $manager->persist($consumption);

                $manager->flush();

                return $this->redirectToRoute('update_stock_cu');
            }
        }
            
    }
}
