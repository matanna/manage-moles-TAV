<?php

namespace App\Form;

use App\Entity\Cu;
use App\Entity\MeuleCu;
use App\Entity\Fournisseur;
use App\Entity\TypeMeuleCu;
use App\Repository\CuRepository;
use App\Utils\TransformInAssocArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MeuleCuType extends AbstractType
{
    private $cuRepository;

    private $transformInAssocArray;

    public function __construct(CuRepository $cuRepository, 
        TransformInAssocArray $transformInAssocArray
    ) {
        $this->cuRepository = $cuRepository;
        $this->transformInAssocArray = $transformInAssocArray;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cus = $this->transformInAssocArray->changeKeyByNameValue($this->cuRepository->findAll());

        $builder
            ->add('ref', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Réference'
                ]
            ])
            ->add('diametre', IntegerType::class, [
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
            ->add('grain', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Grain'
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
            ->add('cu', EntityType::class, [
                'class' => Cu::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'mapped' => false,
                'label' => false
            ])
            ->add('typeMeuleCu', EntityType::class, [
                'class' => TypeMeuleCu::class,
                'choice_label' => 'typeMeule',
                'choice_value' => 'typeMeule',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeuleCu::class,
        ]);
    }
}
