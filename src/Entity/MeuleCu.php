<?php

namespace App\Entity;

use App\Repository\MeuleCuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeuleCuRepository::class)
 */
class MeuleCu
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diametre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hauteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grain;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="meuleCus")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMeuleCu::class, inversedBy="meulesCu")
     */
    private $typeMeuleCu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

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

    public function getDiametre(): ?int
    {
        return $this->diametre;
    }

    public function setDiametre(?int $diametre): self
    {
        $this->diametre = $diametre;

        return $this;
    }

    public function getHauteur(): ?int
    {
        return $this->hauteur;
    }

    public function setHauteur(?int $hauteur): self
    {
        $this->hauteur = $hauteur;

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

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getTypeMeuleCu(): ?TypeMeuleCu
    {
        return $this->typeMeuleCu;
    }

    public function setTypeMeuleCu(?TypeMeuleCu $typeMeuleCu): self
    {
        $this->typeMeuleCu = $typeMeuleCu;

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
}
