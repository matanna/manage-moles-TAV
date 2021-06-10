<?php

namespace App\Controller;

use App\Entity\WheelsCuType;
use App\Repository\WheelsCuRepository;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ManageWheelsTypeCuController extends AbstractController
{
    /**
     * This method process forms TypeMeuleCuType
     * 
     * @Route("/update/{nameCu}/type-meule/{id}", name="update_wheelsType")
     */
    public function updateTypeMeule(DenormalizerInterface $denormalizer, WheelsCuTypeRepository $typeMeuleCuRepository, 
        $nameCu, $id
    ) : Response {

        $datas = $this->get('request_stack')->getCurrentRequest()->request->all();

        //We convert 'stockMini' in integer
        settype($datas['type_meule_cu']['stockMini'], 'integer');
       
        //We convert the 'datas' array in TypeMeuleCu object with a normalizer
        $typeMeuleUpdated = $denormalizer->denormalize($datas['type_meule_cu'], TypeMeuleCu::class);

        $typeMeuleCu = $typeMeuleCuRepository->find($id);

        if(!$typeMeuleCu) {
            throw new NotFoundHttpException('Ce type de meule n\existe pas');
        }

        $typeMeuleCu->setDesignationTAV($typeMeuleUpdated->getDesignationTAV())
                    ->setTypeMeule($typeMeuleUpdated->getTypeMeule())
                    ->setMatiere($typeMeuleUpdated->getMatiere())
                    ->setTypical($typeMeuleUpdated->getTypical())
                    ->setStockMini($typeMeuleUpdated->getStockMini());

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($typeMeuleCu);
        $manager->flush();
        
        return $this->redirectToRoute('edit_cu', [
            'nameCu' => $nameCu
        ]);
    }

    /**
     * @Route("delete/{nameCu}/type-meule/{id}", name="delete_typeMeule")
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
