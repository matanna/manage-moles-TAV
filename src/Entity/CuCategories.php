<?php

namespace App\Entity;

use App\Repository\CuCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuCategoriesRepository::class)
 * @UniqueEntity("name")
 */
class CuCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"display_wheels", "wheels_by_wheelsCuType"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Length(min = 2, max = 15)
     * @Groups({"display_wheels", "wheels_by_wheelsCuType"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=WheelsCuType::class, mappedBy="cuCategory")
     */
    private $wheelsCuTypes;

    public function __construct()
    {
        $this->wheelsCuTypes = new ArrayCollection();
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
     * @return Collection|WheelsCuType[]
     */
    public function getWheelsCuTypes(): Collection
    {
        return $this->wheelsCuTypes;
    }

    public function addWheelsCuType(WheelsCuType $wheelsCuType): self
    {
        if (!$this->wheelsCuTypes->contains($wheelsCuType)) {
            $this->wheelsCuTypes[] = $wheelsCuType;
            $wheelsCuType->setCuCategory($this);
        }

        return $this;
    }

    public function removeWheelsCuType(WheelsCuType $wheelsCuType): self
    {
        if ($this->wheelsCuTypes->removeElement($wheelsCuType)) {
            // set the owning side to null (unless already changed)
            if ($wheelsCuType->getCuCategory() === $this) {
                $wheelsCuType->setCuCategory(null);
            }
        }

        return $this;
    }
}
