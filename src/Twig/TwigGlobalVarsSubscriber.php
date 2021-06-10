<?php

namespace App\Twig;

use Twig\Environment;
use App\Repository\CuRepository;
use App\Repository\RectiMachineRepository;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This event subscriber retrieve all rectilignes and all cus in the database for automatically generate links in the navbar
 */
class TwigGlobalVarsSubscriber implements EventSubscriberInterface
{
    private $cuRepository;

    private $machineRepository;

    private $twig;

    public function __construct(CuRepository $cuRepository, RectiMachineRepository $machineRepository,
        Environment $twig
    ) {
        $this->cuRepository = $cuRepository;
        $this->machineRepository = $machineRepository;
        $this->twig = $twig;
    }

    public static function getSubscribedEvents() {
        return [
            KernelEvents::CONTROLLER =>  'injectGlobalVariables' 
        ];
    }

    public function injectGlobalVariables(Event $event) {
        $rectilignes = $this->machineRepository->findAll();
        $cus = $this->cuRepository->findAll();
        $this->twig->addGlobal( 'rectilignes', $rectilignes);
        $this->twig->addGlobal( 'cus', $cus);
    }
    
}

