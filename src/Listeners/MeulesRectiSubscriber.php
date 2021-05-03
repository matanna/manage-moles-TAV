<?php

namespace App\Listeners;

use App\Events\MeulesRectiChangeEvent;
use App\Repository\MeulesRectiRepository;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MeulesRectiSubscriber implements EventSubscriberInterface
{
    const NAME = 'meulesRecti.subscriber';

    private $meulesRectiRepository;

    private $machineRepository;

    private $manager;

    public function __construct(MeulesRectiRepository $meulesRectiRepository, 
        MachineRepository $machineRepository, EntityManagerInterface $manager
    ) {
        $this->meulesRectiRepository = $meulesRectiRepository;
        $this->machineRepository = $machineRepository;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            MeulesRectiChangeEvent::NAME => 'onChangeMeulesRecti'
        ];
    }

    public function onChangeMeulesRecti(MeulesRectiChangeEvent $event)
    {
        $nameMachine = $event->getNameMachine();
        
        $machine = $this->machineRepository->findOneBy(['name' => $nameMachine]);

        $positions = $event->getMeulesRecti()->getPositions();

        foreach ($positions as $position) {

            //We verif if the postition name is in the machine collection positions
            if (in_array($position, $machine->getPositions()->toArray())) {
                $namePosition = $position->getName();

                //We save the good position
                $positionChanged = $position;  
            }
        }

        //We call datatbase for retrieve moles corresponding to the machine name and the position linked
        //Only one duo between position and machine is ok
        $meules= $this->meulesRectiRepository->findMeulesRectiPerPosition($nameMachine, $namePosition);

        $stockTotal = 0;

        //We do sum on stock for moles having the same positions
        foreach ($meules as $meule) {
            $stockTotal += $meule->getStock();
        }
        
        $positionChanged->setStockReel($stockTotal);

        $this->manager->persist($positionChanged);
        $this->manager->flush();

    }
}