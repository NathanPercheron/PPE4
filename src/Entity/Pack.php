<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackRepository")
 */
class Pack
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
    private $LibellePack;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImagePack;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="packs")
     */
    private $LesServices;

    public function __construct()
    {
        $this->LesServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellePack(): ?string
    {
        return $this->LibellePack;
    }

    public function setLibellePack(string $LibellePack): self
    {
        $this->LibellePack = $LibellePack;

        return $this;
    }

    public function getImagePack(): ?string
    {
        return $this->ImagePack;
    }

    public function setImagePack(string $ImagePack): self
    {
        $this->ImagePack = $ImagePack;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getLesServices(): Collection
    {
        return $this->LesServices;
    }

    public function addLesService(Service $lesService): self
    {
        if (!$this->LesServices->contains($lesService)) {
            $this->LesServices[] = $lesService;
        }

        return $this;
    }

    public function removeLesService(Service $lesService): self
    {
        if ($this->LesServices->contains($lesService)) {
            $this->LesServices->removeElement($lesService);
        }

        return $this;
    }
}
