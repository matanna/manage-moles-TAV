<?php

namespace App\Entity;

use App\Repository\CuConsumptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuConsumptionRepository::class)
 */
class CuConsumption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="cuConsumptions")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity=WheelsCuType::class, inversedBy="cuConsumptions")
     */
    private $wheelsCuType;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWheelsCuType(): ?WheelsCuType
    {
        return $this->wheelsCuType;
    }

    public function setWheelsCuType(?WheelsCuType $wheelsCuType): self
    {
        $this->wheelsCuType = $wheelsCuType;

        return $this;
    }
}
