<?php

namespace App\Notifiers;

use Twig\Environment;
use App\Entity\Position;
use App\Entity\WheelsCuType;
use App\Entity\WheelsRectiMachine;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Notifier\Notification\Notification;

class Notifications
{
    private $notifier;

    private $twig;

    public function __construct(NotifierInterface $notifier, Environment $twig)
    {
        $this->notifier = $notifier;
        $this->twig = $twig;
    }

    /**
     * Send notifications by email to predefined users
     *
     * @param Array $users Array of User objects
     * @param Array $wheelsNeeded
     * @return void
     */
    public function alertStockNotification(Array $users, $wheelsNeeded) 
    {   
        $contentEmail = $this->twig->render('/notifications/notificationsStock.html.twig', [
            'wheelsNeeded' => $wheelsNeeded
        ]);
        dump($contentEmail);
        //$notification = (new Notification('Outils à commander !', ['email']))->content($content);
        
        
        foreach ($users as $user) {

            $recipient = new Recipient(
                $user->getEmail()
            );

            //$this->notifier->send($notification, $recipient);
        }   
    }
    
}
