<?php

namespace App\Listeners;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FormValidationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            FormEvents::POST_SUBMIT => [
                'postSubmit'
            ],
        ];
    }

    public function postSubmit(FormEvents $event)
    {
        dump($event);
    }
}
