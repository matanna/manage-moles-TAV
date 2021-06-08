<?php

namespace App\Controller;

use App\Entity\MeuleCu;
use App\Form\MeuleCuType;
use App\Repository\CuRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeMeuleCuRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageMeuleCuController extends AbstractController
{
    /**
     * @Route("/manage/meule-cu", name="manage_meule_cu")
     */
    public function manageMeuleCu(Request $request, CuRepository $cuRepository,
        EntityManagerInterface $manager
    ): Response {

        $meuleCu = new MeuleCu();

        $request = $this->get('request_stack')->getCurrentRequest();

        if ($request->isXmlHttpRequest()) {
            $cuName = $request->get('cuName');

            $cu = $cuRepository->findCuByName($cuName);

            if (!$cu) {
                throw new NotFoundHttpException("Cette machine n'existe pas");
            }

            return $this->json($cu->getTypeMeuleCus()->toArray(), 200, [], [
                'groups' => 'cu_type_meule'
            ]); 
        }

        $form = $this->get('form.factory')->createNamed('meuleCu', MeuleCuType::class, $meuleCu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $request->request->all();
            
            dump($typeMeuleCu);
            //$manager->persist($meuleCu);
            //$manager->flush();

            return $this->redirectToRoute('manage_meule_cu');
        }

        return $this->render('manage_meule_cu/manageMeuleCu.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
