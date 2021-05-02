<?php

namespace App\Controller;

use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageMolesRectiligneController extends AbstractController
{
    /**
     * @Route("/manage/moles-rectiligne", name="manage_moles_rectiligne")
     */
    public function manageMolesRectiligne(MeulesRectiRepository $meulesRectiRepository
    ): Response {

        $meulesRecti = $meulesRectiRepository->findAll();


        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'meulesRecti' => $meulesRecti
        ]);
    }
}
