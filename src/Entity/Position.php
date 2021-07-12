<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
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
     * 
     * @Groups("wheels_by_positions")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("rectiMachine_positions", "wheels_by_position")
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $stockMini;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $working;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $matters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $stockReal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $totalNotDelivered;

    /**
     * @ORM\ManyToOne(targetEntity=RectiMachine::class, inversedBy="positions")
     * 
     * @Groups("wheels_by_position")
     */
    private $rectiMachine;

    /**
     * @ORM\OneToMany(targetEntity=WheelsRectiMachine::class, mappedBy="position")
     */
    private $wheelsRectiMachines;

    /**
     * @ORM\OneToMany(targetEntity=RectiMachineConsumption::class, mappedBy="position")
     */
    private $consumptions;

    public function __construct()
    {
        $this->wheelsRectiMachines = new ArrayCollection();
        $this->consumptions = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getWorking(): ?string
    {
        return $this->working;
    }

    public function setWorking(?string $working): self
    {
        $this->working = $working;

        return $this;
    }

    public function getMatters(): ?string
    {
        return $this->matters;
    }

    public function setMatters(?string $matters): self
    {
        $this->matters = $matters;
        return $this;
    }

    public function getStockReal(): ?int
    {
        return $this->stockReal;
    }

    public function setStockReal(int $stockReal): self
    {
        $this->stockReal = $stockReal;

        return $this;
    }

    public function getTotalNotDelivered(): ?int
    {
        return $this->totalNotDelivered;
    }

    public function setTotalNotDelivered(?int $totalNotDelivered): self
    {
        $this->totalNotDelivered = $totalNotDelivered;

        return $this;
    }

    public function getRectiMachine(): ?RectiMachine
    {
        return $this->rectiMachine;
    }

    public function setRectiMachine(?RectiMachine $rectiMachine): self
    {
        $this->rectiMachine = $rectiMachine;

        return $this;
    }

    /**
     * @return Collection|WheelsRectiMachine[]
     */
    public function getWheelsRectiMachines(): Collection
    {
        return $this->wheelsRectiMachines;
    }

    public function addWheelsRectiMachine(WheelsRectiMachine $wheelsRectiMachine): self
    {
        if (!$this->wheelsRectiMachines->contains($wheelsRectiMachine)) {
            $this->wheelsRectiMachines[] = $wheelsRectiMachine;
            $wheelsRectiMachine->setPosition($this);
        }

        return $this;
    }

    public function removeMeulesRecti(WheelsRectiMachine $wheelsRectiMachine): self
    {
        if ($this->wheelsRectiMachines->removeElement($wheelsRectiMachine)) {
            // set the owning side to null (unless already changed)
            if ($wheelsRectiMachine->getPosition() === $this) {
                $wheelsRectiMachine->setPosition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RectiMachineConsumption[]
     */
    public function getConsumptions(): Collection
    {
        return $this->consumptions;
    }

    public function addConsumption(RectiMachineConsumption $consumption): self
    {
        if (!$this->consumptions->contains($consumption)) {
            $this->consumptions[] = $consumption;
            $consumption->setPosition($this);
        }

        return $this;
    }

    public function removeConsumption(RectiMachineConsumption $consumption): self
    {
        if ($this->consumptions->removeElement($consumption)) {
            // set the owning side to null (unless already changed)
            if ($consumption->getPosition() === $this) {
                $consumption->setPosition(null);
            }
        }

        return $this;
    }

}