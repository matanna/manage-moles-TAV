<?php

namespace App\Listeners;

use App\Entity\User;
use App\Entity\WheelsCu;
use Doctrine\ORM\Events;
use App\Notifiers\Notifications;
use App\Repository\CuRepository;
use Doctrine\Common\EventSubscriber;
use App\Repository\WheelsCuRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WheelsCuTypeRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class DatabaseActivityCuSubscriber implements EventSubscriber
{
    const NAME = 'database.cu.subscriber';

    private $wheelsCuRepository;

    private $wheelsCuTypeRepository;

    private $manager;

    private $notifications;

    public function __construct(
        WheelsCuRepository $wheelsCuRepository, 
        WheelsCuTypeRepository $wheelsCuTypeRepository, 
        EntityManagerInterface $manager,
        Notifications $notifications
    ) {
        $this->wheelsCuRepository = $wheelsCuRepository;
        $this->wheelsCuTypeRepository = $wheelsCuTypeRepository;
        $this->manager = $manager;
        $this->notifications = $notifications;
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

        if (!$entity instanceof WheelsCu) {
            return;
        }

        $wheelsCuTypes = $this->wheelsCuTypeRepository->findAll();
        
        foreach ($wheelsCuTypes as $wheelsCuType) {

            $wheelsCuByType = $this->wheelsCuRepository->findBy(['wheelsCuType' => $wheelsCuType]);

            $stockTotal = 0;

            foreach ($wheelsCuByType as $wheels) {
                $stockTotal += $wheels->getStock();
            }
    
            $wheelsCuType->setStockReal($stockTotal);

            $this->manager->persist($wheelsCuType);
            $this->manager->flush();
            
        } 
    }
}