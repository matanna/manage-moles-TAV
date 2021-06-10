<?php

namespace App\Form;

use App\Entity\Provider;
use App\Entity\WheelsRectiMachine;
use App\Utils\TransformInAssocArray;
use App\Repository\RectiMachineRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsRectiMachineFormType extends AbstractType
{
    private $rectMachineRepository;

    private $transformInAssocArray;

    public function __construct(RectiMachineRepository $rectiMachineRepository, TransformInAssocArray $transformInAssocArray)
    {
        $this->rectiMachineRepository = $rectiMachineRepository;
        $this->transformInAssocArray = $transformInAssocArray;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $rectiMachine = $this->transformInAssocArray->changeKeyByNameValue($this->rectiMachineRepository->findAll());

        $builder
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
            ->add('diameter',IntegerType::class, [
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
            ])
            ->add('rectiMachine', ChoiceType::class, [
                'choices' => $rectiMachine,
                'mapped' => false,
                'label' => false
            ])
            ->add('position', ChoiceType::class, [
                'mapped' => false,
                'label' => false
            ])
        ;
        $builder->get('position')->resetViewTransformers();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WheelsRectiMachine::class,
        ]);
    }
}
