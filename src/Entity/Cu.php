<?php

namespace App\Entity;

use App\Repository\CuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuRepository::class)
 * @UniqueEntity(
 *      fields={"name"},
 *      message="Ce cu existe déjà"
 * )
 */
class Cu
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
     * @Assert\Length(
     *      min=2,
     *      max=20,
     *      minMessage="Cette valeur doit contenir entre 2 et 20 caractères",
     *      maxMessage="Cette valeur doit contenir entre 2 et 20 caractères"
     * )
     * 
     * @Groups({"display_wheels", "wheels_by_wheelsCuType"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=WheelsCuType::class, mappedBy="cu")
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
            $wheelsCuType->setCu($this);
        }

        return $this;
    }

    public function removeWheelsCuType(WheelsCuType $wheelsCuType): self
    {
        if ($this->wheelsCuTypes->removeElement($wheelsCuType)) {
            // set the owning side to null (unless already changed)
            if ($wheelsCuType->getCu() === $this) {
                $wheelsCuType->setCu(null);
            }
        }

        return $this;
    }

        public function __toString()
    {
        return $this->getName();
    }
}
