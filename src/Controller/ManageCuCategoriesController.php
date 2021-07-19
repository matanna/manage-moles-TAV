<?php

namespace App\Controller;

use App\Entity\CuCategories;
use App\Validator\Validator;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CuCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageCuCategoriesController extends AbstractController
{
    private $manager;

    private $validator;

    private $cuCategoriesRepository;

    public function __construct(EntityManagerInterface $manager, Validator $validator,
        CuCategoriesRepository $cuCategoriesRepository) {

        $this->manager = $manager;
        $this->validator = $validator;
        $this->cuCategoriesRepository = $cuCategoriesRepository;
    }
    
    /**
     * @Route("/manage/add/cuCategory", name="add_new_category")
     */
    public function addNewCategory(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {

            $newCategory = new CuCategories();

            $newNameCategory = $request->get('addNewCategory');

            $newCategory->setName($newNameCategory);

            $errors = $this->validator->validate($newCategory);
            if ($errors) {
                return $this->json($errors, 400);
            }

            $this->manager->persist($newCategory);
            $this->manager->flush();

            return $this->json($newCategory, 200);
        }
    }
    
    /**
     * @Route("/manage/rename/cuCategory/{nameCategory}", name="rename_cuCategory")
     */
    public function renameCuCategory($nameCategory, Request $request): Response {

        if ($request->isXmlHttpRequest()) {
            
            $cuCategory = $this->cuCategoriesRepository->findOneBy(['name' => $nameCategory]);
            
            if (!$cuCategory) {
                throw new NotFoundHttpException('Cette catégorie n\'existe pas');
            }

            $cuCategory->setName($request->get('newNameCategory'));
            
            $errors = $this->validator->validate($cuCategory);
            if ($errors) {
                return $this->json($errors, 400);
            }

            $this->manager->persist($cuCategory);
            $this->manager->flush();

            return $this->json($cuCategory->getName(), 200);
        }
    }

    /**
     * @Route("/manage/delete/cuCategory/{nameCategory}", name="delete_cuCategory")
     */
    public function deleteCuCategory($nameCategory, Request $request): Response {

        if ($request->isXmlHttpRequest()) {

            $cuCategory = $this->cuCategoriesRepository->findOneBy(['name' => $nameCategory]);

            if (!$cuCategory) {
                throw new NotFoundHttpException('Cette catégorie n\'existe pas');
            }

            if (!$cuCategory->getWheelsCuTypes()->isEmpty()) {
                return $this->json(false, 200);
            };

            $this->manager->remove($cuCategory);
            $this->manager->flush();

            return $this->json(true, 200);
        }
    }
}
