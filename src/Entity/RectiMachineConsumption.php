<?php

namespace App\Entity;

use App\Repository\RectiMachineConsumptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RectiMachineConsumptionRepository::class)
 */
class RectiMachineConsumption
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
    private $machineNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $machineSide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $linearMeters;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ref;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="consumptions")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="consumptions")
     */
    private $position;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMachineNumber(): ?string
    {
        return $this->machineNumber;
    }

    public function setMachineNumber(?string $machineNumber): self
    {
        $this->machineNumber = $machineNumber;

        return $this;
    }

    public function getMachineSide(): ?string
    {
        return $this->machineSide;
    }

    public function setMachineSide(?string $machineSide): self
    {
        $this->machineSide = $machineSide;

        return $this;
    }

    public function getLinearMeters(): ?int
    {
        return $this->linearMeters;
    }

    public function setLinearMeters(?int $linearMeters): self
    {
        $this->linearMeters = $linearMeters;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }
}
