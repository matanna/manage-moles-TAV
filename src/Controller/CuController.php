<?php

namespace App\Controller;

use App\Repository\CuRepository;
use App\Utils\TryMolesCu;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CuController extends AbstractController
{
    /**
     * @Route("/cus", name="cus")
     */
    public function stockAllCus(): Response
    {
        return $this->render('cu/all-cus.html.twig', [
            'controller_name' => 'CuController',
        ]);
    }

    /**
     * @Route("/cu/{name}", name="cu")
     */
    public function stockCu(CuRepository $cuRepository, TryMolesCu $tryMoleCu, $name): Response
    {
        $cu = $cuRepository->findCuByName($name);

        $meules = $tryMoleCu->tryMolesPerType($cu->getTypeMeuleCus());
        dump($meules);
        return $this->render('cu/cu.html.twig', [
            'cu' => $cu,
            'meules' => $meules
        ]);
    }
}
