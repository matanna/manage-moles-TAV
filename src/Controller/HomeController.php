<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserPasswordEncoderInterface $encoder): Response
    {
        /*for ($i = 0; $i < 6; $i++) {
           
            $user = new User();

            $string = 'abcdefghijklmnopqrstuvwABCDEFGHIJKLMNOPUVWXY0123456789';
            $length = strlen($string);

            $username = '';

            for ($j = 0; $j < rand(4, 10); $j++) {
                
                $username .= $string[rand(0, $length-1)];
            }

            $user->setUsername($username);

            $user->setPassword('password');

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
       }*/

        return $this->render('home/home.html.twig');
    }
}
