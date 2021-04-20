<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stockMini;

    /**
     * @ORM\ManyToOne(targetEntity=Machine::class, inversedBy="position", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $machine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStockMini(): ?int
    {
        return $this->stockMini;
    }

    public function setStockMini(?int $stockMini): self
    {
        $this->stockMini = $stockMini;

        return $this;
    }

    public function getMachine(): ?Machine
    {
        return $this->machine;
    }

    public function setMachine(Machine $machine): self
    {
        $this->machine = $machine;

        return $this;
    }
}
