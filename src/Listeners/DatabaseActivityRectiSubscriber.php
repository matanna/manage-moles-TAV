<?php

namespace App\Listeners;

use App\Entity\User;
use Doctrine\ORM\Events;
use App\Notifiers\Notifications;
use App\Entity\WheelsRectiMachine;
use Doctrine\Common\EventSubscriber;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RectiMachineRepository;
use App\Repository\WheelsRectiMachineRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * This listener is run at each call to the database with doctrine. Event doctrine listener
 * It do the sum of wheelsRectiMachine quantities and save the total in stockReal in position table
 */
class DatabaseActivityRectiSubscriber implements EventSubscriber
{
    const NAME = 'database.recti.subscriber';

    private $wheelsRectiMachineRepository;

    private $rectiMachineRepository;

    private $positionRepository;

    private $notifications;

    private $manager;

    public function __construct(
        WheelsRectiMachineRepository $wheelsRectiMachineRepository, 
        RectiMachineRepository $rectiMachineRepository, 
        EntityManagerInterface $manager,
        Notifications $notifications,
        PositionRepository $positionRepository
    ) {
        $this->wheelsRectiMachineRepository = $wheelsRectiMachineRepository;
        $this->rectiMachineRepository = $rectiMachineRepository;
        $this->positionRepository = $positionRepository;
        $this->notifications = $notifications;
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

        $positions = $this->positionRepository->findAll();

        foreach ($positions as $position) {
            
            $wheelsByPositions = $this->wheelsRectiMachineRepository->findBy(['position' => $position]);

            $stockTotal = 0;

            //We do sum on stock for moles having the same positions
            foreach ($wheelsByPositions as $wheels) {
                $stockTotal += $wheels->getStock();
            }
            
            $position->setStockReal($stockTotal);

            $this->manager->persist($position);
            $this->manager->flush();

        }
    }
}