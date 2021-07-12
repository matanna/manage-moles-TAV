<?php

namespace App\Listeners;

use App\Entity\WheelsRectiMachine;
use Doctrine\ORM\Events;
use App\Repository\RectiMachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WheelsRectiMachineRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

/**
 * This listener is run at each call to the database with doctrine. Event doctrine listener
 * It do the sum of wheelsRectiMachine quantities and save the total in stockReal in position table
 */
class DatabaseActivityRectiSubscriber implements EventSubscriber
{
    const NAME = 'database.recti.subscriber';

    private $wheelsRectiMachineRepository;

    private $rectiMachineRepository;

    private $manager;

    public function __construct(WheelsRectiMachineRepository $wheelsRectiMachineRepository, 
        RectiMachineRepository $rectiMachineRepository, EntityManagerInterface $manager
    ) {
        $this->wheelsRectiMachineRepository = $wheelsRectiMachineRepository;
        $this->rectiMachineRepository = $rectiMachineRepository;
        $this->manager = $manager;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('persist', $args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->logActivity('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logActivity('update', $args);
    }


    public function logActivity(string $action, LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof WheelsRectiMachine) {
            return;
        }

        $nameRectiMachine = $entity->getPosition()->getRectiMachine()->getName();

        $namePosition = $entity->getPosition()->getName();

        //We call datatbase for retrieve wheels corresponding to the rectiMachine name and the position linked
        //Only one duo between position and rectiMachine is ok
        $wheels = $this->wheelsRectiMachineRepository->findWheelsRectiMachineByPosition($nameRectiMachine, $namePosition);

        $stockTotal = 0;

        //We do sum on stock for moles having the same positions
        foreach ($wheels as $meule) {
            $stockTotal += $meule->getStock();
        }
        
        $entity->getPosition()->setStockReal($stockTotal);

        $this->manager->persist($entity->getPosition());
        $this->manager->flush();
    }
}