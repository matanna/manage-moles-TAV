<?php

namespace App\Controller;

use App\Entity\Cu;
use App\Form\CuType;
use App\Utils\TryMolesCu;
use App\Entity\TypeMeuleCu;
use App\Form\TypeMeuleCuType;
use App\Repository\CuRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeMeuleCuRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ManageCuController extends AbstractController
{
    /**
     * @Route("/manage/cus", name="manage_cus")
     */
    public function manageCu(EntityManagerInterface $manager, Request $request,
        CuRepository $cuRepository, TryMolesCu $tryMolesCu
    ): Response {
        $newCu = new Cu();

        $form = $this->createForm(CuType::class, $newCu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($newCu);
            $manager->flush();

            return $this->redirectToRoute('manage_cus');
        }

        $cus = $cuRepository->findAllCus();

        return $this->render('updateDatabase/manageCus.html.twig', [
            'form' => $form->createView(),
            'allCus' => $cus
        ]);
    }

    /**
     * @Route("/edit/cu/{nameCu}", name="edit_cu")
     */
    public function editCu(CuRepository $cuRepository, TryMolesCu $tryMolesCu, 
        TypeMeuleCuRepository $typeMeuleCuRepository, $nameCu
    ) : Response {

        $cu = $cuRepository->findCuByName($nameCu);

        if (!$cu) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $typesMeuleSorted = $tryMolesCu->tryMolesPerType($cu->getTypeMeuleCus());

        $request = $this->get('request_stack')->getCurrentRequest();

        //This ajax request is used for add form typeMeuleCuType in the modal
        if ($request->isXmlHttpRequest()) {

            //We retrieve 'id' parameter send with the ajax request
            $id = $request->get('id');
            $typeMeuleCu = $typeMeuleCuRepository->find($id);

            if(!$typeMeuleCu) {
                throw new NotFoundHttpException('Ce type de meule n\existe pas');
            }
            
            //We create the form and modify the action at another route
            $form = $this->createForm(TypeMeuleCuType::class, $typeMeuleCu, [
                'action' => $this->generateUrl('update-typeMeule', [
                    'id' => $id,
                    'nameCu' => $nameCu
                ])
            ]);
            
            //We render the view in a twig file and we save this in a variable
            $formRender = $this->render('updateDatabase/editTypeMeule.html.twig', [
                'form' => $form->createView()
            ]);

            //We return the twig file contain the form in a json format
            return $this->json($formRender, 200);
        }

        return $this->render('updateDatabase/editCu.html.twig', [
            'cu' => $cu,
            'typesMeule' => $typesMeuleSorted
        ]);
    }

    /**
     * This method process forms TypeMeuleCuType
     * 
     * @Route("/update/{nameCu}/type-meule/{id}", name="update-typeMeule")
     */
    public function updateTypeMeule(DenormalizerInterface $denormalizer, TypeMeuleCuRepository $typeMeuleCuRepository, 
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
     * @Route("/manage/{nameCu}/change-name", name="change_name_cu")
     */
    public function renameRectiligne(CuRepository $cuRepository,
        EntityManagerInterface $manager, $nameCu
    ) : Response {
        $cu = $cuRepository->findOneBy(['name' => $nameCu]);

        if (!$cu) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();

        if ($data && $data["newCuName"] != NULL) {
            
            $cu->setName($data["newCuName"]);
            
            $manager->persist($cu);
            $manager->flush();

        }

        return $this->redirectToRoute('edit_cu', [
            'nameCu' => $data["newCuName"]
        ]);
    }
}
