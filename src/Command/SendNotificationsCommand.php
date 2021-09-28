<?php

namespace App\Command;

use App\Entity\User;
use App\Notifiers\Notifications;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WheelsCuTypeRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNotificationsCommand extends Command
{
    protected static $defaultName = 'app:send:notifications';

    private $manager;

    private $wheelsCuTypeRepository;

    private $positionRepository;

    private $notification;

    public function __construct(EntityManagerInterface $manager,
        WheelsCuTypeRepository $wheelsCuTypeRepository, 
        PositionRepository $positionRepository,
        Notifications $notifications
    ) {
        $this->manager = $manager;
        $this->wheelsCuTypeRepository = $wheelsCuTypeRepository;
        $this->positionRepository = $positionRepository;
        $this->notifications = $notifications;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Send notifications with email to planned users each day for show them the wheels real stock');
    }

    protected function execute(InputInterface $input, OutputInterface $outpout)
    {
        $io = new SymfonyStyle($input, $outpout);

        $users = $this->manager->getRepository(User::class)->findBy(['isNotifiable' => true]);

        $wheelsCuTypes = $this->wheelsCuTypeRepository->findAll();
        $positions = $this->positionRepository->findAll();

        $wheelsNeeded = [];

        foreach ($wheelsCuTypes as $wheelsCuType) {
            if ($wheelsCuType->getStockReal() <= $wheelsCuType->getStockMini()
                && $wheelsCuType->getStockMini() !== 0
            ) {
                $wheelsNeeded['cu'][] = $wheelsCuType;
            }
        }

        foreach ($positions as $position) {
            if ($position->getStockReal() <= $position->getStockMini()
                && $position->getStockMini() !== 0
            ) {
                $wheelsNeeded['recti'][] = $position;
            }
        }

        $notifs = $this->notifications->alertStockNotification($users, $wheelsNeeded);
        //dump($notifs);
        $io->success(sprintf('Success', $wheelsNeeded));
        
        return 0;
    }
}