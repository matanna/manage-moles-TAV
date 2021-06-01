<?php

namespace App\Entity;

use App\Repository\TypeMeuleCuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeMeuleCuRepository::class)
 */
class TypeMeuleCu
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
    private $designationTAV;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeMeule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matiere;

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
    private $stockReel;

    /**
     * @ORM\ManyToOne(targetEntity=Cu::class, inversedBy="typeMeuleCus")
     */
    private $cu;

    /**
     * @ORM\OneToMany(targetEntity=MeuleCu::class, mappedBy="typeMeuleCu")
     */
    private $meulesCu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nonLivrees;

    public function __construct()
    {
        $this->meulesCu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationTAV(): ?string
    {
        return $this->designationTAV;
    }

    public function setDesignationTAV(?string $designationTAV): self
    {
        $this->designationTAV = $designationTAV;

        return $this;
    }

    public function getTypeMeule(): ?string
    {
        return $this->typeMeule;
    }

    public function setTypeMeule(?string $typeMeule): self
    {
        $this->typeMeule = $typeMeule;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(?string $matiere): self
    {
        $this->matiere = $matiere;

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

    public function getStockReel(): ?int
    {
        return $this->stockReel;
    }

    public function setStockReel(?int $stockReel): self
    {
        $this->stockReel = $stockReel;

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
     * @return Collection|MeuleCu[]
     */
    public function getMeulesCu(): Collection
    {
        return $this->meulesCu;
    }

    public function addMeulesCu(MeuleCu $meulesCu): self
    {
        if (!$this->meulesCu->contains($meulesCu)) {
            $this->meulesCu[] = $meulesCu;
            $meulesCu->setTypeMeuleCu($this);
        }

        return $this;
    }

    public function removeMeulesCu(MeuleCu $meulesCu): self
    {
        if ($this->meulesCu->removeElement($meulesCu)) {
            // set the owning side to null (unless already changed)
            if ($meulesCu->getTypeMeuleCu() === $this) {
                $meulesCu->setTypeMeuleCu(null);
            }
        }

        return $this;
    }

    public function getNonLivrees(): ?int
    {
        return $this->nonLivrees;
    }

    public function setNonLivrees(?int $nonLivrees): self
    {
        $this->nonLivrees = $nonLivrees;

        return $this;
    }
}
