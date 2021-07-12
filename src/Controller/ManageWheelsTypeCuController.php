<?php

namespace App\Controller;

use App\Entity\WheelsCuType;
use App\Repository\WheelsCuRepository;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageWheelsTypeCuController extends AbstractController
{
    

    /**
     * @Route("/manage/delete/{nameCu}/type-meule/{id}", name="delete_typeMeule")
     */
    public function deleteTypMeule(WheelsCuTypeRepository $typeMeuleCuRepository, 
        WheelsCuRepository $meuleCuRepository, $nameCu, $id
    ) : Response {

        $typeMeuleCu = $typeMeuleCuRepository->find($id);

        if(!$typeMeuleCu) {
            throw new NotFoundHttpException('Ce type de meule n\existe pas');
        }

        $meulesCu = $meuleCuRepository->findBy(['typeMeuleCu' => $typeMeuleCu]);

        if ($typeMeuleCu && $meulesCu == NULL) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($typeMeuleCu);
            $manager->flush();
        } else {
            $message = $this->addFlash('warning', 'Des meules sont liés à ce type de meule, la suppression est impossible.'); 
        }

        return $this->redirectToRoute('edit_cu', [
            'nameCu' => $nameCu
        ]);

    }
}
