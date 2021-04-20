<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use App\Repository\MachineRepository;

class BilatController extends AbstractController
{
    /**
     * @Route("/bilat", name="bilat")
     */
    public function stockBilat(MeulesRectiRepository $meulesRectiRepository,
        MachineRepository $machineRepository, EntityManagerInterface $em
    ): Response {

        $stockBilat = $meulesRectiRepository->findAllOrderByPosition();
        
        return $this->render('bilat/bilat.html.twig', [
            "stockBilat" => $stockBilat,
        ]);
    }
}
