<?php

namespace App\Listeners;

use App\Entity\MeuleCu;
use Doctrine\ORM\Events;
use App\Repository\CuRepository;
use Doctrine\Common\EventSubscriber;
use App\Repository\MeuleCuRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeMeuleCuRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class DatabaseActivityCuSubscriber implements EventSubscriber
{
    const NAME = 'database.cu.subscriber';

    private $cuRepository;

    private $meuleCuRepository;

    private $typeMeuleCuRepository;

    private $manager;

    public function __construct(CuRepository $cuRepository, MeuleCuRepository $meuleCuRepository, 
        TypeMeuleCuRepository $typeMeuleCuRepository, EntityManagerInterface $manager
    ) {
        $this->cuRepository = $cuRepository;
        $this->meuleCuRepository = $meuleCuRepository;
        $this->typeMeuleCuRepository = $typeMeuleCuRepository;
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

        if (!$entity instanceof MeuleCu) {
            return;
        }

        $cuName = $entity->getTypeMeuleCu()->getCu()->getName();
        $typeMeule = $entity->getTypeMeuleCu()->getTypeMeule();
        $typical = $entity->getTypeMeuleCu()->getTypical();

        $meules = $this->meuleCuRepository->findMolesCuByTypical($cuName, $typeMeule, $typical);

        $stockTotal = 0;

        foreach ($meules as $meule) {
            $stockTotal += $meule->getStock();
        }

        $typeMeuleCu = $entity->getTypeMeuleCu();
        $typeMeuleCu->setStockReel($stockTotal);

        $this->manager->persist($typeMeuleCu);
        $this->manager->flush();
    }
}