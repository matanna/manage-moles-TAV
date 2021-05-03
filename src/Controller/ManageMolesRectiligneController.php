<?php

namespace App\Controller;

use App\Entity\MeulesRecti;
use App\Form\MeulesRectiType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageMolesRectiligneController extends AbstractController
{
    /**
     * @Route("/manage/moles-rectiligne", name="manage_moles_rectiligne")
     */
    public function manageMolesRectiligne(MeulesRectiRepository $meulesRectiRepository,
        Request $request, EntityManagerInterface $manager
    ): Response {
        $newMeuleRecti = new MeulesRecti();

        $formNewMeule = $this->createForm(MeulesRectiType::class, $newMeuleRecti);
        
        $formNewMeule->handleRequest($request);

        if ($formNewMeule->isSubmitted() && $formNewMeule->isValid()) {
            dump($newMeuleRecti);
            //$manager->persist($newMeuleRecti);
            //$manager->flush();

            return $this->redirectToRoute('manage_moles_rectiligne');
        }

        $meulesRecti = $meulesRectiRepository->findAll();


        return $this->render('manage_moles/manageMolesRectiligne.html.twig', [
            'formNewMeule' => $formNewMeule->createView(),
            'meulesRecti' => $meulesRecti
        ]);
    }
}
