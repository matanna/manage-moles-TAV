<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\WheelsCuTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=WheelsCuTypeRepository::class)
 * @UniqueEntity(
 *      fields={"type"},
 *      message="Ce type de meule existe déjà"
 * )
 */
class WheelsCuType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $working;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $matters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Assert\PositiveOrZero
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     * 
     */
    private $stockMini;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Assert\PositiveOrZero
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $stockReal;

    /**
     * @ORM\ManyToOne(targetEntity=Cu::class, inversedBy="wheelsCuTypes")
     * 
     * Assert\NotBlank
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $cu;

    /**
     * @ORM\OneToMany(targetEntity=WheelsCu::class, mappedBy="wheelsCuType")
     * 
     * @Groups({"display_wheels"})
     */
    private $wheelsCus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Assert\PositiveOrZero
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $totalNotDelivered;

    /**
     * @ORM\ManyToOne(targetEntity=CuCategories::class, inversedBy="wheelsCuTypes")
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"cu_type_wheels", "display_wheels", "wheels_by_wheelsCuType"})
     */
    private $cuCategory;

    /**
     * @ORM\OneToMany(targetEntity=CuConsumption::class, mappedBy="wheelsCuType")
     */
    private $cuConsumptions;

    public function __construct()
    {
        $this->wheelsCu = new ArrayCollection();
        $this->cuConsumptions = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
        if ($this->stockReal === null) {
            return 0;
        }
        return $this->stockReal;
    }

    public function setStockReal(?int $stockReal): self
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

    public function getCuCategory(): ?CuCategories
    {
        return $this->cuCategory;
    }

    public function setCuCategory(?CuCategories $cuCategory): self
    {
        $this->cuCategory = $cuCategory;

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

    /**
     * @return Collection|CuConsumption[]
     */
    public function getCuConsumptions(): Collection
    {
        return $this->cuConsumptions;
    }

    public function addCuConsumption(CuConsumption $cuConsumption): self
    {
        if (!$this->cuConsumptions->contains($cuConsumption)) {
            $this->cuConsumptions[] = $cuConsumption;
            $cuConsumption->setWheelsCuType($this);
        }

        return $this;
    }

    public function removeCuConsumption(CuConsumption $cuConsumption): self
    {
        if ($this->cuConsumptions->removeElement($cuConsumption)) {
            // set the owning side to null (unless already changed)
            if ($cuConsumption->getWheelsCuType() === $this) {
                $cuConsumption->setWheelsCuType(null);
            }
        }

        return $this;
    }
}
