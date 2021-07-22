<?php

namespace App\Notifiers;

use Twig\Environment;
use App\Entity\WheelsCuType;
use App\Entity\WheelsRectiMachine;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Notifier\Notification\Notification;

class Notifications
{
    private $notifier;

    private $rendered;

    public function __construct(NotifierInterface $notifier, Environment $rendered)
    {
        $this->notifier = $notifier;
        $this->rendered = $rendered;
    }

    /**
     * Send notifications by email to predefined users
     *
     * @param Array $users Array of User objects
     * @param WheelsCu $wheelsCu
     * @param WheelsRectiMachine $wheelsRectiMachine
     * @return void
     */
    public function alertStockNotification(Array $users, WheelsCuType $wheelsCuType = null, 
        Position $position = null
    ) {
        if ($wheelsCuType) {
            $content = "Le stock mini pour $wheelsCuType est atteint.";
        }

        if ($position) {
            $content = "Le stock mini pour $position est atteint.";
        }

        $notification = (new Notification('Outils à commander !', ['email']))
            ->content($content);
        dump($content);

        foreach ($users as $user) {

            $recipient = new Recipient(
                $user->getEmail()
            );

            //$this->notifier->send($notification, $recipient);
        }
        

    }
}
