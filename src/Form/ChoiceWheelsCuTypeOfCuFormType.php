<?php

namespace App\Form;

use App\Entity\Cu;
use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceWheelsCuTypeOfCuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cu', EntityType::class, [
                'class' => Cu::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => false
            ])
            ->add('categories', EntityType::class, [
                'class' => CuCategories::class,
                'choices' => $options['categories'],
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => false
            ])
            ->add('wheelsCuType', EntityType::class, [
                'class' => WheelsCuType::class,
                'choice_label' => 'type',
                'choice_value' => 'type',
                'choices' => $options['wheelsCuType'],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'wheelsCuType' => null,
            'categories' => null,
            'csrf_protection' => false
        ]);
    }
}
