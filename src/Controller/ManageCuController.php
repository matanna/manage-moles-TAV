<?php

namespace App\Controller;

use App\Entity\Cu;
use App\Form\CuFormType;
use App\Utils\SortWheelsCu;
use App\Repository\CuRepository;
use App\Form\WheelsCuTypeFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageCuController extends AbstractController
{
    /**
     * @Route("/manage/cus", name="manage_cus")
     */
    public function manageCu(EntityManagerInterface $manager, Request $request,
        CuRepository $cuRepository, SortWheelsCu $sortWheelsCu
    ): Response {
        $newCu = new Cu();

        if ($request->isXmlHttpRequest()) {

            $cuName = $request->get('cuName');

            if (!$cuName) {
                throw new NotFoundHttpException("Cette machine n'existe pas");
            }

            $wheelsCuTypes = $sortWheelsCu->sortWheelsCuByType($cuRepository->findCuByName($cuName)->getWheelsCuTypes());

            dump($wheelsCuTypes);

            return $this->json($wheelsCuTypes, 200, [], [
                'groups' => 'display_wheels'
            ]);
        }

        $form = $this->createForm(CuFormType::class, $newCu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($newCu);
            $manager->flush();

            return $this->redirectToRoute('manage_cus');
        }

        $cus = $cuRepository->findAllCus();

        return $this->render('manage-machines/manageCus.html.twig', [
            'form' => $form->createView(),
            'allCus' => $cus
        ]);
    }

    /**
     * @Route("/edit/cu/{nameCu}", name="edit_cu")
     */
    public function editCu(CuRepository $cuRepository, SortWheelsCu $sortWheelsCu, 
        WheelsCuTypeRepository $wheelsCuTypeRepository, $nameCu
    ) : Response {

        $cu = $cuRepository->findCuByName($nameCu);

        if (!$cu) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $wheelsCuTypeSorted =$sortWheelsCu->sortWheelsCuByType($cu->getWheelsCuTypes());

        $request = $this->get('request_stack')->getCurrentRequest();

        //This ajax request is used for add form WheelsCuTypeFormType in the modal
        if ($request->isXmlHttpRequest()) {

            //We retrieve 'id' parameter send with the ajax request
            $id = $request->get('id');
            $wheelsCuType = $wheelsCuTypeRepository->find($id);

            if(!$wheelsCuType) {
                throw new NotFoundHttpException('Ce type de meule n\existe pas');
            }
            
            //We create the form and modify the action at another route
            $form = $this->createForm(WheelsCuTypeFormType::class, $wheelsCuType, [
                'action' => $this->generateUrl('update_wheelsType', [
                    'id' => $id,
                    'nameCu' => $nameCu
                ])
            ]);
            
            //We render the view in a twig file and we save this in a variable
            $formRender = $this->render('updateDatabase/editWheelsCuType.html.twig', [
                'form' => $form->createView()
            ]);

            //We return the twig file contain the form in a json format
            return $this->json($formRender, 200);
        }

        return $this->render('manage-machine/editCu.html.twig', [
            'cu' => $cu,
            'wheelsCuType' => $wheelsCuTypeSorted
        ]);
    }

     /**
     * @Route("/manage/{nameCu}/change-name", name="change_name_cu")
     */
    public function renameCu(CuRepository $cuRepository,
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

    /**
     * @Route("delete/cu/{id}", name="delete_cu")
     */
    public function deleteCu(CuRepository $cuRepository, 
        WheelsCuTypeRepository $wheelsCuTypeRepository, $id
    ) : Response {

        $cu = $cuRepository->find($id);

        if (!$cu) {
            throw new NotFoundHttpException("Cette machine n'existe pas");
        }

        $typeMeuleCus = $wheelsCuTypeRepository->findBy(['cu' => $cu]);

        if ($cu && $typeMeuleCus == NULL) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($cu);
            $manager->flush();
        } else {
            $message = $this->addFlash('warning', 'Des types de meules sont liés à ce centre d\'usinage, la suppression est impossible.'); 
        }

        return $this->redirectToRoute('manage_cus');
    }
}
