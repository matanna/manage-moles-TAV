<?php

namespace App\Form;

use App\Entity\Cu;
use App\Entity\MeuleCu;
use App\Entity\Fournisseur;
use App\Repository\CuRepository;
use App\Utils\TransformInAssocArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MeuleCuType extends AbstractType
{
    private $cuRepository;

    private $transformInAssocArray;

    public function __construct(CuRepository $cuRepository, TransformInAssocArray $transformInAssocArray)
    {
        $this->cuRepository = $cuRepository;
        $this->transformInAssocArray = $transformInAssocArray;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cus = $this->transformInAssocArray->changeKeyByNameValue($this->cuRepository->findAll());

        $builder
            ->add('ref', TextType::class)
            ->add('diametre', IntegerType::class)
            ->add('hauteur', IntegerType::class)
            ->add('grain', TextType::class)
            ->add('stock', IntegerType::class)
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'name'
            ])
            ->add('cu', ChoiceType::class, [
                'choices' => $cus,
                'mapped' => false,
                'data' => ''
            ])
            ->add('typeMeuleCu', ChoiceType::class, [
                
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
