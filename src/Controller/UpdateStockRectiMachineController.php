<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateStockRectiMachineController extends AbstractController
{
    /**
     * @Route("/update/stock/rectiMachine", name="update_stock_rectiMachine")
     */
    public function updateStockRectiMachine(): Response
    {
        return $this->render('rectiMachine/updateStockRectiMachine.html.twig', [
           
        ]);
    }
}
