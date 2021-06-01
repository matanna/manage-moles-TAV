<?php

namespace App\Listeners;

use App\Entity\MeulesRecti;
use Doctrine\ORM\Events;
use App\Repository\MachineRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MeulesRectiRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

class DatabaseActivityRectiSubscriber implements EventSubscriber
{
    const NAME = 'database.recti.subscriber';

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

        if (!$entity instanceof MeulesRecti) {
            return;
        }

        $nameMachine = $entity->getPosition()->getMachine()->getName();

        $namePosition = $entity->getPosition()->getName();

        //We call datatbase for retrieve moles corresponding to the machine name and the position linked
        //Only one duo between position and machine is ok
        $meules= $this->meulesRectiRepository->findMeulesRectiPerPosition($nameMachine, $namePosition);

        $stockTotal = 0;

        //We do sum on stock for moles having the same positions
        foreach ($meules as $meule) {
            $stockTotal += $meule->getStock();
        }
        
        $entity->getPosition()->setStockReel($stockTotal);

        $this->manager->persist($entity->getPosition());
        $this->manager->flush();
    }
}