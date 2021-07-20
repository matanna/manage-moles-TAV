<?php

namespace App\Form;

use App\Entity\Cu;
use App\Entity\Provider;
use App\Entity\WheelsCu;
use App\Entity\CuCategories;
use App\Entity\WheelsCuType;
use Symfony\Component\Form\AbstractType;
use App\Repository\CuCategoriesRepository;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsCuFormType extends AbstractType
{    
    /**
     * cuCategoriesRepository
     *
     * @var CuCategoriesRepository
     */
    private $cuCategoriesRepository;
    
    /**
     * wheelsCuTypeRepository
     *
     * @var WheelsCuTypeRepository
     */
    private $wheelsCuTypeRepository;
    
    /**
     * requestStack
     *
     * @var RequestStack
     */
    private $requestStack;
    
    public function __construct(CuCategoriesRepository $cuCategoriesRepository, 
        WheelsCuTypeRepository $wheelsCuTypeRepository, RequestStack $requestStack
    ) {
        $this->cuCategoriesRepository = $cuCategoriesRepository;
        $this->wheelsCuTypeRepository = $wheelsCuTypeRepository;
        $this->requestStack = $requestStack;
    }

    /**
     * Form builder for WheelsCu
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = null;
        $cu = null;

        //We check if post datas are submitted in the request and in this case we get list of categories and wheelsCuTypes for inject them in choices list
        if ($this->requestStack->getCurrentRequest()->get('wheelsCu')) { 
            $datas = $this->getPostDatas();

            $options['categories'] = $datas['categories'];
            $options['wheelsCuType'] = $datas['wheelsCuType'];
        }

        //If the form is edit an existing wheelsCu, we get parameters for inject them in choices list and in preselected data
        if ($options['wheels'] && $options['wheels']->getId()) {
            
            $cu = $options['wheels']->getWheelsCuType() ? $options['wheels']->getWheelsCuType()->getCu() : null;
            $category = $options['wheels']->getWheelsCuType() ? $options['wheels']->getWheelsCuType()->getCuCategory() : null;
            
            $options['categories'] = $this->getCategories($cu->getName());
            $options['wheelsCuType'] = $this->getWheelsCuTypes($cu->getName(), $category->getName());
            //dump($options['wheelsCuType']);
        }
       
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
            ]);
        ;
    }
    
    /**
     * Method configureOptions
     *
     * @param OptionsResolver $resolver 
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WheelsCu::class,
            'wheelsCuType' => null,
            'categories' => null,
            'wheels' => null
        ]);
    }
    
    /**
     * Method getPostDatas
     * 
     * This method check if post datas are in the request.
     * (when erros validations for example)
     *
     * @return array
     */
    private function getPostDatas()
    {
        $cuName = $this->requestStack->getCurrentRequest()->get('wheelsCu')['cu'];
        $categoryName = $this->requestStack->getCurrentRequest()->get('wheelsCu')['categories'];

        $datas['categories'] = $this->getCategories($cuName);
        $datas['wheelsCuType'] = $this->getWheelsCuTypes($cuName, $categoryName);

        return $datas;
    }

    private function getCategories($cuName)
    {
        return $this->cuCategoriesRepository->findCuCategoriesByCu(($cuName));
    }

    private function getWheelsCuTypes($cuName, $categoryName)
    {
        return $this->wheelsCuTypeRepository->findWheelsCuTypeByCuAndByCategory($cuName, $categoryName);
    
    }
}
