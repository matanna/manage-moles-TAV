<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateStockCuController extends AbstractController
{
    /**
     * @Route("/update/stock/cu", name="update_stock_cu")
     */
    public function index(): Response
    {
        return $this->render('cu/updateStockCu.html.twig');
    }
}
