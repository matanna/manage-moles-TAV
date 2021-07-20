<?php

namespace App\Controller;

use App\Entity\WheelsCu;
use App\Form\WheelsCuFormType;
use App\Repository\CuRepository;
use App\Repository\WheelsCuRepository;
use App\Repository\CuCategoriesRepository;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageWheelsCuController extends AbstractController
{
    private $wheelsCuTypeRepository;

    private $cuCategoriesRepository;

    public function __construct(WheelsCuTypeRepository $wheelsCuTypeRepository,
        CuCategoriesRepository $cuCategoriesRepository
    ) {
        $this->wheelsCuTypeRepository = $wheelsCuTypeRepository;
        $this->cuCategoriesRepository = $cuCategoriesRepository;
    }

    /**
     * @Route("/manage/wheels-cu", name="manage_wheels_cu")
     */
    public function manageWheelsCu(Request $request, CuRepository $cuRepository,
        WheelsCuRepository $wheelsCuRepository, ValidatorInterface $validator
    ): Response {

        //Initialisation of session variables for adapt form new wheels when an errors happen
        $wheelsCuTypesNew = null;
        $categoriesNew = null;

        $session = $request->getSession();
        

        //We check if variables are in the session - if yes, we save them to add them in $form and we remove them from the session
        if ($session->get('categoriesNew')) {
            $categoriesNew = $session->get('categoriesNew');
            $session->set('categoriesNew', null);

        }
        if ($session->get('wheelsCuTypeNew')) {
            $wheelsCuTypesNew = $session->get('wheelsCuTypeNew');
            $session->set('wheelsCuTypeNew', null);
        }
        
        $manager = $this->getDoctrine()->getManager();

        //We create the form for add a new wheels
        $newWheelsCu = new WheelsCu();
        $form = $this->get('form.factory')->createNamed('wheelsCu', WheelsCuFormType::class, $newWheelsCu, [
            'wheelsCuType' => $wheelsCuTypesNew,
            'categories' => $categoriesNew
        ]);

        $form->handleRequest($request);
        
        //process the form
        if ($form->isSubmitted()) {
            
            if ($form->isValid()) {
                $manager->persist($newWheelsCu);
                $manager->flush();

                return $this->redirectToRoute('manage_wheels_cu');
            }

            /**
             * if errors, we retrieve categories and wheelsCutype for send them in session. 
             * The user don't must change the category and wheelsCuType another time
             */
            if ($validator->validate($newWheelsCu)->count() > 0 ) {
                $datas = $request->request->all();
                $categories = $this->cuCategoriesRepository->findCuCategoriesByCu([$datas['wheelsCu']['cu']]);
                $wheelsCuTypes = $this->wheelsCuTypeRepository->findWheelsCuTypeByCuAndByCategory(
                    $datas['wheelsCu']['cu'],
                    $datas['wheelsCu']['categories']
                );

                $session->set('categoriesNew', $categories);
                $session->set('wheelsCuTypeNew', $wheelsCuTypes);
            }
        } 

        //Initialisation of session variables for adapt form edit wheels when an errors happen
        $wheelsCuTypesEdit = null;
        $categoriesEdit = null;

        //We check if variables are in the session - if yes, we save them to add them in $form and we remove them from the session
        if ($session->get('categoriesEdit')) {
            $categoriesNew = $session->get('categoriesEdit');
            $session->set('categoriesEdit', null);
        }
        if ($session->get('wheelsCuTypeEdit')) {
            $wheelsCuTypesNew = $session->get('wheelsCuTypeEdit');
            $session->set('wheelsCuTypeEdit', null);
        }

        //We retrieve all wheelsCu
        $wheelsCu = $wheelsCuRepository->findAllWheelsCu();
        
        $editWheelsCuFormTable = [];

        foreach ($wheelsCu as $wheels) {
            
            $editWheelsCuForm = $this->get('form.factory')->createNamed('wheelsCu_' . $wheels->getId(), WheelsCuFormType::class, $wheels, [
                'wheelsCuType' => $wheelsCuTypesEdit,
                'categories' => $categoriesEdit,
                'wheels' => $wheels
            ]);
            
            $editWheelsCuForm->handleRequest($request);

            if ($editWheelsCuForm->isSubmitted()) {
                
                if ($editWheelsCuForm->isValid()) {
                    
                    $manager->persist($wheels);
                    $manager->flush();
    
                    return $this->redirectToRoute('manage_wheels_cu');
                }

                /**
                 * if errors, we retrieve categories and wheelsCutype for send them in session. 
                 * The user don't must change the category and wheelsCuType another time
                 */
                if ($validator->validate($newWheelsCu)->count() > 0 ) {
                    $datas = $request->request->all();
                    $categories = $this->cuCategoriesRepository->findCuCategoriesByCu([$datas['wheelsCu']['cu']]);
                    $wheelsCuTypes = $this->wheelsCuTypeRepository->findWheelsCuTypeByCuAndByCategory(
                        $datas['wheelsCu']['cu'],
                        $datas['wheelsCu']['categories']
                    );

                    $session->set('categories', $categoriesEdit);
                    $session->set('wheelsCuType', $wheelsCuTypesEdit);
                }
            }
            
            $editWheelsCuFormTable[$wheels->getId()] = $editWheelsCuForm->createView();
        }

        return $this->render('manage_wheels/manageWheelsCu.html.twig', [
            'form' => $form->createView(),
            'wheelsCu' => $wheelsCu,
            'editWheelsCuFormTable' =>$editWheelsCuFormTable    
        ]);
    }

    /**
     * @Route("/manage/adapt/wheels-cu-type", name="adapt-wheels-cu-type")
     */
    public function newWheelsCu(Request $request, CuRepository $cuRepository,
        WheelsCuRepository $wheelsCuRepository
    ): Response {

        //Ajax for adapt wheels type in terms of cu name
        if ($request->isXmlHttpRequest()) {

            $cuName = $request->get('cuName');
            
            $cu = $cuRepository->findCuByName($cuName);

            if (!$cu ) {
                throw new NotFoundHttpException("Cette machine n'existe pas");
            }

            $category = $request->get('categoryName');

            $categories = $this->cuCategoriesRepository->findCuCategoriesByCu($cuName);

            if (!$category) {
                $wheelsCuType = null;
            } else {
                $wheelsCuType = $this->wheelsCuTypeRepository->findWheelsCuTypeByCuAndByCategory($cuName, $category);
            }

            if ($request->get('wheelsCuId')) {
                $wheelsCu = $wheelsCuRepository->findOneBy(['id' => $request->get('wheelsCuId')]);
                $nameForm = 'wheelsCu_' . $request->get('wheelsCuId');

            } else {
                $wheelsCu = new WheelsCu();
                $nameForm = 'wheelsCu';
            }
            
            $wheelsCuForm = $this->get('form.factory')->createNamed($nameForm, WheelsCuFormType::class, $wheelsCu, [
                'wheelsCuType' => $wheelsCuType,
                'categories' => $categories,
            ]);

            $view = $this->render("manage_wheels/manageWheelsCuAjax.html.twig", [
                'wheelsCuForm' => $wheelsCuForm->createView()
            ]);
            
            return $this->json($view, 200); 
        }
    }

    /**
     * @Route("/manage/delete/wheels-cu/{id}", name="delete-wheels-cu")
     */
    public function deleteWheelsCu(WheelsCuRepository $wheelsCuRepository, $id): Response
    {
        $wheelsCu = $wheelsCuRepository->findOneBy(['id' => $id]);

        if (!$wheelsCu) {
            throw new NotFoundHttpException("Cette meule n'existe pas");
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($wheelsCu);
        $manager->flush();

        return $this->redirectToRoute('manage_wheels_cu');

    }
}
