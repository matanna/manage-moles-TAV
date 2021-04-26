<?php

namespace App\Listeners;

use App\Events\MeulesRectiChangeEvent;
use App\Repository\MeulesRectiRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MeulesRectiSubscriber implements EventSubscriberInterface
{
    const NAME = 'meulesRecti.subscriber';

    private $meulesRectiRepository;

    public function __construct(MeulesRectiRepository $meulesRectiRepository)
    {
        $this->meulesRectiRepository = $meulesRectiRepository;
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
        


        
    }
}