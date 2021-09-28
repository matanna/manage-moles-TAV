<?php

namespace App\Controller;

use Exception;
use App\Utils\SortWheelsCu;
use App\Repository\CuRepository;
use App\Repository\WheelsCuRepository;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockWheelsCuController extends AbstractController
{
    /**
     * @Route("/cu/{name}", name="cu")
     */
    public function stockCu(CuRepository $cuRepository, SortWheelsCu $sortWheelsCu, 
        WheelsCuTypeRepository $wheelsCuTypeRepository, $name
    ): Response {

        $user = $this->getUser();

        $request = $this->get('request_stack')->getCurrentRequest();

        $cu = $cuRepository->findCuByName($name);

        $wheels = $cu->getWheelsCuTypes();
        
        if(count($wheels) === 0) {
            throw new Exception('Aucunes meules n\'est enregistrée pour le centre d\'usinage : ' . ucfirst($name));
        }

        $wheelsStored = $sortWheelsCu->sortWheelsCuByType($wheels);

        $data['user'] = $user;
      

        if ($request->isXmlHttpRequest()) {
            $wheelsCuType = $wheelsCuTypeRepository->findWheelsCuType($request->request->get('idWheelsCuType'));
            $data['wheelsCuType'] = $wheelsCuType;
            
            return $this->json($data, 200, [], [
                'groups' => ['display_wheels', 'current_user']
            ]);
        }
        
        return $this->render('cu/cu.html.twig', [
            'cu' => $cu,
            'wheels' => $wheelsStored
        ]);
    }

    /**
     * @Route("/cu/change-quantity/{id}", name="cu-wheels-change-quantity")
     */
    public function updateQuantityCuMole(WheelsCuRepository $wheelsCuRepository,
        Request $request, $id
    ) : Response {
 
        if ($request->isXmlHttpRequest()) {
            $wheels = $wheelsCuRepository->find($id);

            if (!$wheels) {
                throw new NotFoundHttpException('Cette page n\'existe pas');
            }

            $data = (int)($request->get('quantity'));
            
            if ($data !== null) {
                
                $wheels->setStock($data);
            
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($wheels);
                $manager->flush();

            }

            return $this->json($wheels->getStock(), 200);
        }
        

    }
}
