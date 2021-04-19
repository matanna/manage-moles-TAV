<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BilatController extends AbstractController
{
    /**
     * @Route("/bilat", name="bilat")
     */
    public function index(): Response
    {
        return $this->render('bilat/bilat.html.twig', [
            'controller_name' => 'StockBilatController',
        ]);
    }
}
