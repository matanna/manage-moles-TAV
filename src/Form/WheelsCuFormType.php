<?php

namespace App\Form;

use App\Entity\Cu;
use App\Entity\Provider;
use App\Entity\WheelsCu;
use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use App\Repository\CuRepository;
use App\Utils\TransformInAssocArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsCuFormType extends AbstractType
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
        
        if ($options['wheels'] && $options['wheels']->getId()) {
            $cu = $options['wheels']->getWheelsCuType()->getCu();
            $category = $options['wheels']->getWheelsCuType()->getCuCategory();
        } else {
            $cu = null;
            $category = null;
        }
        dump($options['wheelsCuType']);
        $builder
            ->add('ref', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Réference'
                ]
            ])
            ->add('tavname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Désignation TAV'
                ]
            ])
            ->add('diameter', IntegerType::class, [
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
            ->add('provider', EntityType::class, [
                'class' => Provider::class,
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('cu', EntityType::class, [
                'class' => Cu::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'mapped' => false,
                'label' => false,
                'data' => $cu
            ])
            ->add('categories', EntityType::class, [
                'class' => CuCategories::class,
                'choices' => $options['categories'],
                'choice_label' => 'name',
                'choice_value' => 'name',
                'mapped' => false,
                'label' => false,
                'data' => $category
            ])
            ->add('wheelsCuType', EntityType::class, [
                'class' => WheelsCuType::class,
                'choices' => $options['wheelsCuType'],
                'choice_label' => 'type',
                'choice_value' => 'type',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WheelsCu::class,
            'wheelsCuType' => null,
            'categories' => null,
            'wheels' => null
        ]);
    }
}
