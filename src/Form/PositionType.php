<?php

namespace App\Form;

use App\Entity\Machine;
use App\Entity\Position;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Position (1, 2, 3,...)'
                ]
            ])
            ->add('type', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Type (Boisseau, Périph,...)'
                ]
            ])
            ->add('usinage', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Usinage (Talon,...)'
                ]
            ])
            ->add('matiere', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Matière (Diamanté,...)'
                ]
            ])
            ->add('stockMini', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Stock mini'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Position::class,
        ]);
    }
}
