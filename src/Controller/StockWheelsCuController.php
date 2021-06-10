<?php

namespace App\Controller;

use Exception;
use App\Utils\SortWheelsCu;
use App\Repository\CuRepository;
use App\Repository\WheelsCuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockWheelsCuController extends AbstractController
{
    /**
     * @Route("/cu/{name}", name="cu")
     */
    public function stockCu(CuRepository $cuRepository, SortWheelsCu $sortWheelsCu, $name): Response
    {
        $cu = $cuRepository->findCuByName($name);

        $wheels = $cu->getWheelsCuTypes();
        
        if(count($wheels) === 0) {
            throw new Exception('Aucunes meules n\'est enregistrée pour le centre d\'usinage : ' . ucfirst($name));
        }

        $wheelsStored = $sortWheelsCu->sortWheelsCuByType($wheels);
        
        return $this->render('cu/cu.html.twig', [
            'cu' => $cu,
            'wheels' => $wheelsStored
        ]);
    }

    /**
     * @Route("/cu/{name}/change-quantity/{id}", name="cu-meule-change-quantity")
     */
    public function updateQuantityCuMole(WheelsCuRepository $wheelsCuRepository,
        $name, $id
    ) : Response {
 
        $wheels = $wheelsCuRepository->find($id);

        if (!$wheels) {
            throw new NotFoundHttpException('Cette page n\'existe pas');
        }

        $data = $this->get('request_stack')->getCurrentRequest()->request->all();

        if ($data && $data["quantity"] != NULL) {
            
            $wheels->setStock($data["quantity"]);
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($wheels);
            $manager->flush();

        }

        return $this->redirectToRoute("cu", [
            'name' => $name
        ]);

    }
}
