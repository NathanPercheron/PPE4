<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibellePartenaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="partenaires")
     */
    private $ServicePartenaire;

    public function __construct()
    {
        $this->ServicePartenaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellePartenaire(): ?string
    {
        return $this->LibellePartenaire;
    }

    public function setLibellePartenaire(string $LibellePartenaire): self
    {
        $this->LibellePartenaire = $LibellePartenaire;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServicePartenaire(): Collection
    {
        return $this->ServicePartenaire;
    }

    public function addServicePartenaire(Service $servicePartenaire): self
    {
        if (!$this->ServicePartenaire->contains($servicePartenaire)) {
            $this->ServicePartenaire[] = $servicePartenaire;
        }

        return $this;
    }

    public function removeServicePartenaire(Service $servicePartenaire): self
    {
        if ($this->ServicePartenaire->contains($servicePartenaire)) {
            $this->ServicePartenaire->removeElement($servicePartenaire);
        }

        return $this;
    }
}
