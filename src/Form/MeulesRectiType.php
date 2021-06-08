<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\MeulesRecti;
use App\Utils\TransformInAssocArray;
use App\Repository\MachineRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MeulesRectiType extends AbstractType
{
    private $machineRepository;

    private $transformInAssocArray;

    public function __construct(MachineRepository $machineRepository, TransformInAssocArray $transformInAssocArray)
    {
        $this->machineRepository = $machineRepository;
        $this->transformInAssocArray = $transformInAssocArray;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $machine = $this->transformInAssocArray->changeKeyByNameValue($this->machineRepository->findAll());

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
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('machine', ChoiceType::class, [
                'choices' => $machine,
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
            'data_class' => MeulesRecti::class,
        ]);
    }
}
