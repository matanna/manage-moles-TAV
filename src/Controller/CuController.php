<?php

namespace App\Controller;

use Exception;
use App\Utils\TryMolesCu;
use App\Repository\CuRepository;
use App\Repository\MeuleCuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CuController extends AbstractController
{
    /**
     * @Route("/cu/{name}", name="cu")
     */
    public function stockCu(CuRepository $cuRepository, TryMolesCu $tryMoleCu, $name): Response
    {
        $cu = $cuRepository->findCuByName($name);

        $meules = $cu->getTypeMeuleCus();
        dump($meules);
        if(count($meules) === 0) {
            throw new Exception('Aucunes meules n\'est enregistrée pour le centre d\'usinage : ' . ucfirst($name));
        }

        $meulesStored = $tryMoleCu->tryMolesPerType($meules);
        
        return $this->render('cu/cu.html.twig', [
            'cu' => $cu,
            'meules' => $meulesStored
        ]);
    }

    /**
     * @Route("/cu/{name}/change-quantity/{id}", name="cu-meule-change-quantity")
     */
    public function updateQuantityCuMole(MeuleCuRepository $meuleCuRepository,
        $name, $id
    ) : Response {
 
        $meule = $meuleCuRepository->find($id);

        if (!$meule) {
            throw new NotFoundHttpException('Cette page n\'existe pas');
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();

        if ($data && $data["quantity"] != NULL) {
            
            $meule->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($meule);
            $manager->flush();

        }

        return $this->redirectToRoute("cu", [
            'name' => $name
        ]);

    }
}
