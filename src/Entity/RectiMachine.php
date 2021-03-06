<?php

namespace App\Entity;

use App\Entity\Position;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RectiMachineRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups as Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=RectiMachineRepository::class)
 * 
 * @UniqueEntity(
 *      fields={"name"},
 *      message="Cette machine existe déjà"
 * )
 */
class RectiMachine
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
     * @ORM\Column(type="string", length=255, unique=true)
     * 
     * @Assert\Length(
     *      min=2,
     *      max=20,
     *      minMessage="Cette valeur doit contenir entre 2 et 20 caractères",
     *      maxMessage="Cette valeur doit contenir entre 2 et 20 caractères"
     * )
     * 
     * @Groups("wheels_by_position")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Position::class, mappedBy="rectiMachine", cascade={"persist"}, orphanRemoval=true)
     */
    private $positions;

    public function __construct()
    {
        $this->positions = new ArrayCollection();
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection|Position[]
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions[] = $position;
            $position->setRectiMachine($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->removeElement($position)) {
            // set the owning side to null (unless already changed)
            if ($position->getRectiMachine() === $this) {
                $position->setRectiMachine(null);
            }
        }

        return $this;
    }

    
}
