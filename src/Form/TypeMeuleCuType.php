<?php

namespace App\Form;

use App\Entity\TypeMeuleCu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeMeuleCuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designationTAV', TextType::class, [
                'label' => false
            ])
            ->add('typeMeule', TextType::class, [
                'label' => false
            ])
            ->add('matiere', TextType::class, [
                'label' => false
            ])
            ->add('typical', TextType::class, [
                'label' => false
            ])
            ->add('stockMini', IntegerType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeMeuleCu::class,
        ]);
    }
}
