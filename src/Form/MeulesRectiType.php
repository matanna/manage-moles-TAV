<?php

namespace App\Form;

use App\Entity\MeulesRecti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeulesRectiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('designationTAV')
            ->add('grain')
            ->add('diametre')
            ->add('hauteur')
            ->add('stock')
            ->add('position')
            ->add('nonLivres')
            ->add('machine')
            ->add('fournisseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeulesRecti::class,
        ]);
    }
}
