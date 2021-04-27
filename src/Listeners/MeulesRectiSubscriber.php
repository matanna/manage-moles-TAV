<?php

namespace App\Listeners;

use App\Events\MeulesRectiChangeEvent;
use App\Repository\MeulesRectiRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MeulesRectiSubscriber implements EventSubscriberInterface
{
    const NAME = 'meulesRecti.subscriber';

    private $meulesRectiRepository;

    private $positionRepository;

    private $manager;

    public function __construct(MeulesRectiRepository $meulesRectiRepository, 
        PositionRepository $positionRepository, EntityManagerInterface $manager
    ) {
        $this->meulesRectiRepository = $meulesRectiRepository;
        $this->positionRepository = $positionRepository;
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
        $position = $event->getMeulesRecti()->getPosition();
        
        $meules = $this->meulesRectiRepository->findMeulesRectiPerPosition($nameMachine, $position);
        
        $stockTotal = 0;

        foreach ($meules as $meule) {
            $stockTotal += $meule->getStock();
        }

        $position = $this->positionRepository->findOnePositionPerMachine($nameMachine, $position);
        dump($position);
        $position->setStockReel($stockTotal);

        $this->manager->persist($position);
        $this->manager->flush();

    }
}