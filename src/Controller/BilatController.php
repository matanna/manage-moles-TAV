<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use App\Repository\PositionRepository;

class BilatController extends AbstractController
{
    /**
     * @Route("/bilat", name="bilat")
     */
    public function stockBilat(MeulesRectiRepository $meulesRectiRepository,
        PositionRepository $positionRepository
    ): Response {

        $nameMachine = 'BILATERALE';

        $stockBilat = $meulesRectiRepository->findAllOrderByPosition($nameMachine);
        
        $stockMini = $positionRepository->findPositionByMachine($nameMachine);
        dump($stockMini);
        return $this->render('bilat/bilat.html.twig', [
            "stockBilat" => $stockBilat,
            "stockMiniTable" => $stockMini
        ]);
    }
}
