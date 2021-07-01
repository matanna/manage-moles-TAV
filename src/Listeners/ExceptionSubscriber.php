<?php

// src/EventSubscriber/ExceptionSubscriber.php
namespace App\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                'onKernelException'
            ],
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {
        
        $exception = $event->getThrowable();

        if ($exception instanceof AccessDeniedHttpException) {

            return $event->setResponse(new RedirectResponse($this->urlGenerator->generate('home')));
        }
    }
}
