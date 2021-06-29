<?php

namespace App\Entity;

use App\Entity\Position;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\WheelsRectiMachineRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=WheelsRectiMachineRepository::class)
 */
class WheelsRectiMachine
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
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TAVname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grain;

    /**
     * @ORM\Column(type="integer")
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="wheelsRectiMachines")
     */
    private $provider;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $notDelivered;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="wheelsRectiMachines")
     */
    private $position;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getTAVname(): ?string
    {
        return $this->TAVname;
    }

    public function setTAVname(string $TAVname): self
    {
        $this->TAVname = $TAVname;

        return $this;
    }

    public function getGrain(): ?string
    {
        return $this->grain;
    }

    public function setGrain(?string $grain): self
    {
        $this->grain = $grain;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

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

    public function getNotDelivered(): ?int
    {
        return $this->notDelivered;
    }

    public function setNotDelivered(?int $notDelivered): self
    {
        $this->notDelivered = $notDelivered;

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
