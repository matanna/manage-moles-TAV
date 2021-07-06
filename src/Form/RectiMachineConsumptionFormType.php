<?php

namespace App\Form;

use App\Entity\RectiMachineConsumption;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RectiMachineConsumptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('machineNumber', TextType::class, [
                'label' => 'Numéro de la machine'
            ])
            ->add('machineSide', ChoiceType::class, [
                'choices' => [
                    'Pas de coté' => null,
                    'Fixe' => 'fixe',
                    'Mobile' => 'mobil' 
                ],
                'label' => 'Coté de la machine',
            ])
            ->add('linearMeters', IntegerType::class, [
                'label' => 'Mètres linéaires',
                'required' => false
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RectiMachineConsumption::class,
        ]);
    }
}
