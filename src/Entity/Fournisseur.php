<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
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
     * @ORM\OneToMany(targetEntity=MeulesRecti::class, mappedBy="fournisseur")
     */
    private $meulesRectis;

    public function __construct()
    {
        $this->meulesRectis = new ArrayCollection();
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
     * @return Collection|MeulesRecti[]
     */
    public function getMeulesRectis(): Collection
    {
        return $this->meulesRectis;
    }

    public function addMeulesRecti(MeulesRecti $meulesRecti): self
    {
        if (!$this->meulesRectis->contains($meulesRecti)) {
            $this->meulesRectis[] = $meulesRecti;
            $meulesRecti->setFournisseur($this);
        }

        return $this;
    }

    public function removeMeulesRecti(MeulesRecti $meulesRecti): self
    {
        if ($this->meulesRectis->removeElement($meulesRecti)) {
            // set the owning side to null (unless already changed)
            if ($meulesRecti->getFournisseur() === $this) {
                $meulesRecti->setFournisseur(null);
            }
        }

        return $this;
    }
}
