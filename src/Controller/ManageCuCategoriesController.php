<?php

namespace App\Controller;

use App\Entity\CuCategories;
use App\Repository\CuCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageCuCategoriesController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
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

            $this->manager->persist($newCategory);
            $this->manager->flush();

            return $this->json($newCategory, 200);
        }
    }
    
    /**
     * @Route("/manage/rename/cuCategory/{nameCategory}", name="rename_cuCategory")
     */
    public function renameCuCategory($nameCategory, CuCategoriesRepository $cuCategoriesRepository,
        Request $request
    ): Response {

        if ($request->isXmlHttpRequest()) {
            
            $cuCategory = $cuCategoriesRepository->findOneBy(['name' => $nameCategory]);
            
            if (!$cuCategory) {
                throw new NotFoundHttpException('Cette catégorie n\'existe pas');
            }

            $cuCategory->setName($request->get('newNameCategory'));
            
            $this->manager->persist($cuCategory);
            $this->manager->flush();

            return $this->json($cuCategory->getName(), 200);
        }
    }

    /**
     * @Route("/manage/delete/cuCategory/{nameCategory}", name="delete_cuCategory")
     */
    public function deleteCuCategory($nameCategory, CuCategoriesRepository $cuCategoriesRepository,
        Request $request
    ): Response {

        if ($request->isXmlHttpRequest()) {

            $cuCategory = $cuCategoriesRepository->findOneBy(['name' => $nameCategory]);

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
