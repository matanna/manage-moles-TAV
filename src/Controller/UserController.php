<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $manager;

    private $userRepository;

    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("admin/users", name="users")
     */
    public function manageUsers(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $newUser = new User();

        $newUserForm = $this->createForm(UserFormType::class, $newUser);

        $users = $this->userRepository->findAll();

        $usersTable = [];

        foreach ($users as $user) {
            $userForm = $this->get('form.factory')->createNamed('form-user-' . $user->getId(), UserFormType::class, $user, [
                'role' => $user->getRoles()[0]
            ]);
            $userFormView = $userForm->createView();
            $userForm->handleRequest($request);

            $usersTable[$user->getId()]['user'] = $user;
            $usersTable[$user->getId()]['userForm'] = $userFormView;

            if ($userForm->isSubmitted() && $userForm->isValid()) {
                $this->manager->persist($userForm);
                $this->manager->flush();

                return $this->redirectToRoute('users');
            }
        }

        $newUserForm->handleRequest($request);

        if ($newUserForm->isSubmitted() && $newUserForm->isValid()) {
            
            $newUser->setPassword($encoder->encodePassword($newUser, $newUser->getPassword()));
            
            $newUser->setRoles([$request->request->get('user_form')['roles']]);
            
            $this->manager->persist($newUser);
            $this->manager->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('user/manageUsers.html.twig', [
            'newUserForm' => $newUserForm->createView(),
            'usersTable' => $usersTable
        ]);
    }
}
