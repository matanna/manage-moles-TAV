<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProviderRepository::class)
 */
class Provider
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
     * @ORM\OneToMany(targetEntity=WheelsRectiMachine::class, mappedBy="provider")
     */
    private $wheelsRectiMachines;

    /**
     * @ORM\OneToMany(targetEntity=WheelsCu::class, mappedBy="provider")
     */
    private $wheelsCus;

    public function __construct()
    {
        $this->wheelsRectiMachines = new ArrayCollection();
        $this->wheelsCus = new ArrayCollection();
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
     * @return Collection|WheelsRectiMachine[]
     */
    public function getWheelsRectiMachines(): Collection
    {
        return $this->wheelsRectiMachines;
    }

    public function addWheelsRectiMachine(WheelsRectiMachine $wheelsRectiMachine): self
    {
        if (!$this->wheelsRectiMachines->contains($wheelsRectiMachine)) {
            $this->wheelsRectiMachines[] = $wheelsRectiMachine;
            $wheelsRectiMachine->setProvider($this);
        }

        return $this;
    }

    public function removeWheelsRectiMachine(WheelsRectiMachine $wheelsRectiMachine): self
    {
        if ($this->wheelsRectiMachines->removeElement($wheelsRectiMachine)) {
            // set the owning side to null (unless already changed)
            if ($wheelsRectiMachine->getProvider() === $this) {
                $wheelsRectiMachine->setProvider(null);
            }
        }

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
            $wheelsCu->setProvider($this);
        }

        return $this;
    }

    public function removeWheelsCu(WheelsCu $wheelsCu): self
    {
        if ($this->meuleCus->removeElement($wheelsCu)) {
            // set the owning side to null (unless already changed)
            if ($wheelsCu->getProvider() === $this) {
                $wheelsCu->setProvider(null);
            }
        }

        return $this;
    }
}
