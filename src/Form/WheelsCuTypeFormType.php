<?php

namespace App\Form;

use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsCuTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuCategory', EntityType::class, [
                'class' => CuCategories::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Catégorie'
            ])
            ->add('type', TextType::class, [
                'label' => false
            ])
            ->add('working', TextType::class, [
                'label' => false
            ])
            ->add('matters', TextType::class, [
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
            'data_class' => WheelsCuType::class,
        ]);
    }
}
