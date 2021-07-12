<?php

namespace App\Form;

use App\Entity\Position;
use App\Entity\RectiMachine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoicePositionOfRectiMachineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rectiMachine', EntityType::class, [
                'class' => RectiMachine::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => false
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'choices' => $options['positions'],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'positions' => null,
            'csrf_protection' => false
        ]);
    }
}
