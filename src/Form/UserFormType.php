<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Nom d'utilisateur"  
            ])
            ->add('roles', ChoiceType::class,[
                'choices' => [
                    'Opérateur' => 'ROLE_USER', 
                    'Encadrement' => 'ROLE_SUPER_USER', 
                    'Administrateur' => 'ROLE_ADMIN', 
                ],
                'expanded' => true,
                'mapped' => false,
                'label' => false,
                'data' => $options['role']
            ])
            ->add('password', PasswordType::class, [
                'label' => "Mot de passe"
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'required' => false
            ])
            ->add('isNotifiable', ChoiceType::class, [
                'choices' => [
                    "OUI" => 1,
                    "NON" => 0
                ],
                'data' => 0,
                'label' => "Notifications"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'role' => null
        ]);
    }
}
