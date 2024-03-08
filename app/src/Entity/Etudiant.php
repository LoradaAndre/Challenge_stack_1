<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'id_etudiant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $id_classe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->id_classe;
    }

    public function setIdClasse(?Classe $id_classe): static
    {
        $this->id_classe = $id_classe;

        return $this;
    }
}
