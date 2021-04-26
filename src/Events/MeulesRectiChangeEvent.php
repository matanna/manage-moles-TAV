<?php

namespace App\Events;

use App\Entity\MeulesRecti;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * This event is dispatched each times an mole is update or create ("stock" and "nonLivrées")
 */
class MeulesRectiChangeEvent extends Event
{
    public const NAME = 'meulesRecti.change';

    protected $meulesRecti;

    protected $nameMachine;

    public function __construct(MeulesRecti $meulesRecti, $nameMachine)
    {
        $this->meulesRecti = $meulesRecti;
        $this->nameMachine = $nameMachine;
    }

    public function getMeulesRecti(): MeulesRecti
    {
        return $this->meulesRecti;
    }

    public function getNameMachine()
    {
        return $this->nameMachine;
    }
}