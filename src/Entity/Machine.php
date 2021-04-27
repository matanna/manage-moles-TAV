<?php

namespace App\Entity;

use App\Entity\Position;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MachineRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=MeulesRecti::class, mappedBy="machine")
     */
    private $meulesRectis;

    /**
     * @ORM\OneToMany(targetEntity=Position::class, mappedBy="machine", cascade={"persist", "remove"})
     */
    private $position;

    public function __construct()
    {
        $this->meulesRectis = new ArrayCollection();
        $this->position = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|MeulesRecti[]
     */
    public function getMeulesRectis(): Collection
    {
        return $this->meulesRectis;
    }

    public function addMeulesRecti(MeulesRecti $meulesRecti): self
    {
        if (!$this->meulesRectis->contains($meulesRecti)) {
            $this->meulesRectis[] = $meulesRecti;
            $meulesRecti->addMachine($this);
        }

        return $this;
    }

    public function removeMeulesRecti(MeulesRecti $meulesRecti): self
    {
        if ($this->meulesRectis->removeElement($meulesRecti)) {
            $meulesRecti->removeMachine($this);
        }

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPosition(): Collection
    {
        return $this->position;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->position->contains($position)) {
            $this->position->add($position);
        }

        return $this;
    }

    public function removePosition(Position $position): void
    {
        $this->position->removeElement($position);
    }
    
    public function setPosition(Position $position): self
    {
        // set the owning side of the relation if necessary
        if ($position->getMachine() !== $this) {
            $position->setMachine($this);
        }

        $this->position = $position;

        return $this;
    }

    
}
