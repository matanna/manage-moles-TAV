<?php

namespace App\Form;

use App\Entity\TypeMeuleCu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TypeMeuleCuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designationTAV')
            ->add('typeMeule')
            ->add('matiere')
            ->add('typical')
            ->add('stockMini', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeMeuleCu::class,
        ]);
    }
}
