<?php

namespace App\Controller;

use App\Entity\Cu;
use App\Entity\MeuleCu;
use App\Entity\TypeMeuleCu;
use App\Repository\FournisseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        //Fixture for Meules Cu
        /*$cus = ['Masters', 'Vertmax', 'Masters/Vertmax'];
        $manager = $this->getDoctrine()->getManager();

        foreach($cus as $cu) {
            $newCu = new Cu();
            $newCu->setName($cu);
           

            $manager->persist($newCu);
            $manager->flush();

            for ($i = 0; $i < rand(4, 8); $i++) {
                $newTypeMeuleCu = new TypeMeuleCu();

                $typeUsinage = ['Foret', 'Trapèzoidale', 'Fraise', 'Diabolo', 'Ebauche'];
                $typeUsinage_keys = array_rand($typeUsinage, 1);

                $matiere = ['Diamanté', 'Polissante', 'Résine'];
                $matiere_keys= array_rand($matiere, 1);

                $verre = ['4mm', '5mm', '8mm', '6mm', 'Tout'];
                $verre_keys = array_rand($verre, 1);

                $newTypeMeuleCu->setDesignationTAV('désignation' . $i)
                               ->setTypeUsinage($typeUsinage[$typeUsinage_keys])
                               ->setMatiere($matiere[$matiere_keys])
                               ->setTypeVerre($verre[$verre_keys])
                               ->setStockMini(rand(2, 10))
                               ->setCu($newCu);
                $manager->persist($newTypeMeuleCu);
                $manager->flush();

                for ($j = 0; $j < rand(1, 4); $j++) {
                    $newMeuleCu = new MeuleCu();

                    $diametre = array_rand(['150', '100', '20', '10', '170'], 1);
                   

                    $newMeuleCu->setRef('Reference-n' . $i . '_' . $j)
                               ->setDiametre(rand(10, 150))
                               ->setHauteur(rand(10, 100))
                               ->setGrain('grain' . $i . '_' . $j);
                    $manager->persist($newMeuleCu);
                    $manager->flush();
                }
            }
        }*/

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
