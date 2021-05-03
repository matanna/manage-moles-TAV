<?php

namespace App\Form;

use App\Entity\MeulesRecti;
use App\Form\MachineType;
use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MeulesRectiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Réference'
                ]
            ])
            ->add('designationTAV', TextType::class, [
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
            ->add('diametre',IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Diamètre'
                ]
            ])
            ->add('hauteur', IntegerType::class, [
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
            ->add('machine', CollectionType::class, [
                'entry_type' => MachineChoiceType::class,
                'allow_add' => true,
                'label' => false,
                'by_reference' => false
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'name',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeulesRecti::class,
        ]);
    }
}
