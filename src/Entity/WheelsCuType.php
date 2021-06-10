<?php

namespace App\Entity;

use App\Repository\WheelsCuTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WheelsCuTypeRepository::class)
 */
class WheelsCuType
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
    private $TAVname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("cu_type_meule")
     */
    private $wheelsType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typical;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stockMini;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stockReal;

    /**
     * @ORM\ManyToOne(targetEntity=Cu::class, inversedBy="wheelsCuTypes")
     */
    private $cu;

    /**
     * @ORM\OneToMany(targetEntity=WheelsCu::class, mappedBy="wheelsCuType")
     */
    private $wheelsCus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalNotDelivered;

    public function __construct()
    {
        $this->wheelsCu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTAVname(): ?string
    {
        return $this->TAVname;
    }

    public function setTAVname(?string $TAVname): self
    {
        $this->TAVname = $TAVname;

        return $this;
    }

    public function getWheelsType(): ?string
    {
        return $this->wheelsType;
    }

    public function setWheelsType(?string $wheelsType): self
    {
        $this->wheelsType = $wheelsType;

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

    public function getTypical(): ?string
    {
        return $this->typical;
    }

    public function setTypical(?string $typical): self
    {
        $this->typical = $typical;

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

    public function getStockReal(): ?int
    {
        return $this->stockReal;
    }

    public function setStockReel(?int $stockReal): self
    {
        $this->stockReal = $stockReal;

        return $this;
    }

    public function getCu(): ?Cu
    {
        return $this->cu;
    }

    public function setCu(?Cu $cu): self
    {
        $this->cu = $cu;

        return $this;
    }

    /**
     * @return Collection|WheelsCu[]
     */
    public function getWheelsCus(): Collection
    {
        return $this->wheelsCus;
    }

    public function addWheelsCu(WheelsCu $wheelsCu): self
    {
        if (!$this->wheelsCus->contains($wheelsCu)) {
            $this->wheelsCus[] = $wheelsCu;
            $wheelsCu->setWheelsCuType($this);
        }

        return $this;
    }

    public function removeWheelsCu(WheelsCu $wheelsCu): self
    {
        if ($this->wheelsCus->removeElement($wheelsCu)) {
            // set the owning side to null (unless already changed)
            if ($wheelsCu->getWheelsCuType() === $this) {
                $wheelsCu->setWheelsCuType(null);
            }
        }

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
}
