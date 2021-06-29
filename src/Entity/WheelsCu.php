<?php

namespace App\Entity;

use App\Repository\WheelsCuRepository;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WheelsCuRepository::class)
 */
class WheelsCu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"display_wheels"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $tavName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $grain;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="wheelsCus")
     * 
     * @Groups({"display_wheels"})
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity=WheelsCuType::class, inversedBy="wheelsCus")
     */
    private $wheelsCuType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"display_wheels"})
     */
    private $stock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $notDelivered;

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

    public function getTavName(): ?string
    {
        return $this->tavName;
    }

    public function setTavName(?string $tavName): self
    {
        $this->tavName = $tavName;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
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

    public function getGrain(): ?string
    {
        return $this->grain;
    }

    public function setGrain(?string $grain): self
    {
        $this->grain = $grain;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

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
}
