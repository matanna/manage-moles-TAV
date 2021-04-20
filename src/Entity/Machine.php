<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="array", nullable=true)
     */
    private $position = [];

    public function __construct()
    {
        $this->meulesRectis = new ArrayCollection();
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

    public function getPosition(): ?array
    {
        return $this->position;
    }

    public function setPosition(?array $position): self
    {
        $this->position = $position;

        return $this;
    }

}
