<?php

namespace App\Entity;

use App\Entity\Position;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\WheelsRectiMachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=WheelsRectiMachineRepository::class)
 * 
 * @UniqueEntity(
 *      fields={"ref"},
 *      message="Cette meule existe déjà"
 * )
 */
class WheelsRectiMachine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("wheels_by_position")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\NotBlank
     * 
     * @Groups("wheels_by_position")
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     * @Groups("wheels_by_position")
     */
    private $TAVname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $grain;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Assert\Positive
     * 
     * @Groups("wheels_by_position")
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups("wheels_by_position")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Assert\PositiveOrZero
     * 
     * @Groups("wheels_by_position")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="wheelsRectiMachines")
     * 
     * @Groups("wheels_by_position")
     */
    private $provider;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Assert\PositiveOrZero
     * 
     * @Groups("wheels_by_position")
     */
    private $notDelivered;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="wheelsRectiMachines")
     * 
     * @Assert\NotBlank
     * 
     * @Groups("wheels_by_position")
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
        if ($this->stock === null) {
            return 0;
        }
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
