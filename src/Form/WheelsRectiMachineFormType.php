<?php

namespace App\Form;

use App\Entity\Position;
use App\Entity\Provider;
use App\Entity\RectiMachine;
use App\Entity\WheelsRectiMachine;
use App\Repository\PositionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WheelsRectiMachineFormType extends AbstractType
{
    /**
     * requestStack
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     * positionRepository
     *
     * @var PostionRepository
     */
    private $positionRepository;
    
    public function __construct(RequestStack $requestStack,
        PositionRepository $positionRepository
    ) {
        $this->requestStack = $requestStack;
        $this->positionRepository = $positionRepository;
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

        //We check if post datas are submitted in the request and in this case we get list of positions for inject them in choices list
        if ($this->requestStack->getCurrentRequest()->get('wheels_recti_machine_form')) { 
            $datas = $this->getPostDatas();
            $options['positions'] = $datas['positions'];
        }

        
        $builder
            ->add('rectiMachine', EntityType::class, [
                'class' => RectiMachine::class,
                'mapped' => false,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => false
            ])
            ->add('position', EntityType::class, [
                    'class' => Position::class,
                    'choice_label' => 'name',
                    'choices' => $options['positions'],
                    'label' => false
            ])
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
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WheelsRectiMachine::class,
            'positions' => null
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
        $rectiMachineName = $this->requestStack->getCurrentRequest()->get('wheels_recti_machine_form')['rectiMachine'];
        
        $datas['positions'] = $this->getPositions($rectiMachineName);

        return $datas;
    }

    /**
     * This method retrieve positions by rectiMachine
     *
     * @param [string] $rectiMachineName
     * @return array
     */
    private function getPositions($rectiMachineName)
    {
        $positions = $this->positionRepository->findPositionByRectiMachine($rectiMachineName);
        
        return $positions;
    }
}
