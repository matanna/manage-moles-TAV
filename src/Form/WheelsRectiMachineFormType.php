<?php

namespace App\Form;

use App\Entity\Position;
use App\Entity\Provider;
use App\Entity\RectiMachine;
use App\Entity\WheelsRectiMachine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsRectiMachineFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) 
    {

        $builder
            ->add('rectiMachine', EntityType::class, [
                'class' => RectiMachine::class,
                'mapped' => false,
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('position', EntityType::class, [
                    'class' => Position::class,
                    'choice_label' => 'name',
                    'choices' => $options['positions'],
                    'label' => false
            ])
            ->add('ref', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Réference'
                ]
            ])
            ->add('TAVname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Désignation'
                ]
            ])
            ->add('grain', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Grain'
                ]
            ])
            ->add('diameter', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Diamètre'
                ]
            ])
            ->add('height', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Hauteur'
                ]
            ])
            ->add('stock', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Stock'
                ]
            ])
            ->add('provider', EntityType::class, [
                'class' => Provider::class,
                'choice_label' => 'name',
                'label' => false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WheelsRectiMachine::class,
            'positions' => null
        ]);
    }
}
