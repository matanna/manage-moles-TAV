<?php

namespace App\Controller;

use App\Repository\CuCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageCuCategoriesController extends AbstractController
{
    /**
     * @Route("/manage/rename/cuCategory/{nameCategory}", name="rename_cuCategory")
     */
    public function renameCuCategory(Request $request, $nameCategory, 
        CuCategoriesRepository $cuCategoriesRepository
    ): Response {

        if ($request->isXmlHttpRequest()) {
            
            $cuCategory = $cuCategoriesRepository->findOneBy(['name' => $nameCategory]);

            if (!$cuCategory) {
                throw new NotFoundHttpException('Cette catégorie nèxiste pas');
            }

            $cuCategory->setName($request->get('newNameCategory'));
            dump($cuCategory);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cuCategory);
            $manager->flush();

            return $this->json($cuCategory->getName(), 200);
        }
    }
}
