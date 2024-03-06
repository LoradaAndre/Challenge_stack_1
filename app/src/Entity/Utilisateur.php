<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_profil = null;

    #[ORM\Column]
    private ?bool $admin = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photo_profil;
    }

    public function setPhotoProfil(string $photo_profil): static
    {
        $this->photo_profil = $photo_profil;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function getPassword(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

        public function getRoles(): array
    {
        // Retournez un tableau de rôles de l'utilisateur
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // Vous pouvez implémenter cette méthode si nécessaire, elle est généralement vide
    }

    
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

}
