<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $traduit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Langue", inversedBy="projets")
     */
    private $langProj;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langue", inversedBy="projets")
     */
    private $langTrad;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Source", mappedBy="projet")
     */
    private $sources;

    public function __construct()
    {
        $this->langTrad = new ArrayCollection();
        $this->sources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTraduit(): ?bool
    {
        return $this->traduit;
    }

    public function setTraduit(bool $traduit): self
    {
        $this->traduit = $traduit;

        return $this;
    }

    public function getLangProj(): ?Langue
    {
        return $this->langProj;
    }

    public function setLangProj(?Langue $langProj): self
    {
        $this->langProj = $langProj;

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangTrad(): Collection
    {
        return $this->langTrad;
    }

    public function addLangTrad(Langue $langTrad): self
    {
        if (!$this->langTrad->contains($langTrad)) {
            $this->langTrad[] = $langTrad;
        }

        return $this;
    }

    public function removeLangTrad(Langue $langTrad): self
    {
        if ($this->langTrad->contains($langTrad)) {
            $this->langTrad->removeElement($langTrad);
        }

        return $this;
    }

    /**
     * @return Collection|Source[]
     */
    public function getSources(): Collection
    {
        return $this->sources;
    }

    public function addSource(Source $source): self
    {
        if (!$this->sources->contains($source)) {
            $this->sources[] = $source;
            $source->setProjet($this);
        }

        return $this;
    }

    public function removeSource(Source $source): self
    {
        if ($this->sources->contains($source)) {
            $this->sources->removeElement($source);
            // set the owning side to null (unless already changed)
            if ($source->getProjet() === $this) {
                $source->setProjet(null);
            }
        }

        return $this;
    }

}
