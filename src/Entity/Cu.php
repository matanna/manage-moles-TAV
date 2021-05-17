<?php

namespace App\Entity;

use App\Repository\CuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuRepository::class)
 */
class Cu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity=TypeMeuleCu::class, mappedBy="cu")
     */
    private $typeMeuleCus;
    public function __construct()
    {
        $this->typeMeuleCus = new ArrayCollection();
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
     * @return Collection|TypeMeuleCu[]
     */
    public function getTypeMeuleCus(): Collection
    {
        return $this->typeMeuleCus;
    }

    public function addTypeMeuleCu(TypeMeuleCu $typeMeuleCu): self
    {
        if (!$this->typeMeuleCus->contains($typeMeuleCu)) {
            $this->typeMeuleCus[] = $typeMeuleCu;
            $typeMeuleCu->setCu($this);
        }

        return $this;
    }

    public function removeTypeMeuleCu(TypeMeuleCu $typeMeuleCu): self
    {
        if ($this->typeMeuleCus->removeElement($typeMeuleCu)) {
            // set the owning side to null (unless already changed)
            if ($typeMeuleCu->getCu() === $this) {
                $typeMeuleCu->setCu(null);
            }
        }

        return $this;
    }
}
