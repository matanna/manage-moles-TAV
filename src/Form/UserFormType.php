<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => "Nom d'utilisateur"
                ],
                'label' => false
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
                'attr' => [
                    'placeholder' => "Mot de passe"
                ],
                'label' => false
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
