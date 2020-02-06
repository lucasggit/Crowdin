<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email est déja utilisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="votre mot de passe 
     * doit avoir minimum 8 caracères")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Vos mots de passe ne sont pas identiques")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vos mots de passe ne sont pas identiques")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="user")
     */
    private $projets;

    /**
     * @ORM\Column(type="boolean")
     */
    private $traducteur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langue", inversedBy="users")
     * @Assert\Count(
     *     min = 1,
     *     minMessage = "Vous devez au moins selectionner une langue"
     * )
     * 
     */
    private $language;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->language = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return Collection|Projet[]
     */
            public function getProjets(): Collection
            {
                return $this->projets;
            }

            public function addProjet(Projet $projet): self
            {
                if (!$this->projets->contains($projet)) {
                    $this->projets[] = $projet;
                    $projet->setUser($this);
                }

                return $this;
            }

            public function removeProjet(Projet $projet): self
            {
                if ($this->projets->contains($projet)) {
                    $this->projets->removeElement($projet);
                    // set the owning side to null (unless already changed)
                    if ($projet->getUser() === $this) {
                        $projet->setUser(null);
                    }
                }

                return $this;
            }

            public function getTraducteur(): ?bool
            {
                return $this->traducteur;
            }

            public function setTraducteur(bool $traducteur): self
            {
                $this->traducteur = $traducteur;

                return $this;
            }

            public function __toString()
            {
                return $this->username;
            }

            /**
             * @return Collection|Langue[]
             */
            public function getLanguage(): Collection
            {
                return $this->language;
            }

            public function addLanguage(Langue $language): self
            {
                if (!$this->language->contains($language)) {
                    $this->language[] = $language;
                }

                return $this;
            }

            public function removeLanguage(Langue $language): self
            {
                if ($this->language->contains($language)) {
                    $this->language->removeElement($language);
                }

                return $this;
            }
    }
