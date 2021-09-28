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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            
            $userForm->handleRequest($request);

            $usersTable[$user->getId()]['user'] = $user;
            
            if ($userForm->isSubmitted() && $userForm->isValid()) {
                
                $datas = $request->request->all();
                $user->setRoles([$datas['form-user-' . $user->getId()]['roles']]);
                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
                
                $this->manager->persist($user);
                $this->manager->flush();

                return $this->redirectToRoute('users');
            }
            
            $userFormView = $userForm->createView();
            $usersTable[$user->getId()]['userForm'] = $userFormView;
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

    /**
     * @Route("admin/delete/user/{userId}", name="delete_user")
     */
    public function deleteUser($userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);

        if(!$user) {
            throw new NotFoundHttpException('Cet utilisateur n\'existe pas'); 
        }

        $this->manager->remove($user);
        $this->manager->flush();

        return $this->redirectToRoute('users');
    }
}
