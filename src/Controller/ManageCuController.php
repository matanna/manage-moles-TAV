<?php

namespace App\Controller;

use App\Entity\Cu;
use App\Form\CuType;
use App\Utils\TryMolesCu;
use App\Form\TypeMeuleCuType;
use App\Repository\CuRepository;
use App\Repository\TypeMeuleCuRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        if ($request->isXmlHttpRequest()) {

            $id = $request->get('id');
            $typeMeuleCu = $typeMeuleCuRepository->find($id);

            if(!$typeMeuleCu) {
                throw new NotFoundHttpException('Ce type de meule n\existe pas');
            }

            $form = $this->createForm(TypeMeuleCuType::class, $typeMeuleCu);
            
            $formRender = $this->render('updateDatabase/editTypeMeule.html.twig', [
                'form' => $form->createView()
            ]);

            return $this->json($formRender, 200);
        }

        return $this->render('updateDatabase/editCu.html.twig', [
            'cu' => $cu,
            'typesMeule' => $typesMeuleSorted
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
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cu);
            $manager->flush();

        }

        return $this->redirectToRoute('edit_cu', [
            'nameCu' => $data["newCuName"]
        ]);
    }
}
