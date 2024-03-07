<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $id_formation = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Organisme $id_organisme = null;

    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'id_classe')]
    private Collection $id_cours;

    #[ORM\OneToMany(mappedBy: 'id_classe', targetEntity: Etudiant::class, fetch: 'EAGER')]
    private Collection $id_etudiant;



    public function __construct()
    {
        $this->id_cours = new ArrayCollection();
        $this->id_etudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIdFormation(): ?Formation
    {
        return $this->id_formation;
    }

    public function setIdFormation(?Formation $id_formation): static
    {
        $this->id_formation = $id_formation;

        return $this;
    }

    public function getIdOrganisme(): ?Organisme
    {
        return $this->id_organisme;
    }

    public function setIdOrganisme(?Organisme $id_organisme): static
    {
        $this->id_organisme = $id_organisme;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getIdCours(): Collection
    {
        return $this->id_cours;
    }

    public function addIdCour(Cours $idCour): static
    {
        if (!$this->id_cours->contains($idCour)) {
            $this->id_cours->add($idCour);
            $idCour->addIdClasse($this);
        }

        return $this;
    }

    public function removeIdCour(Cours $idCour): static
    {
        if ($this->id_cours->removeElement($idCour)) {
            $idCour->removeIdClasse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getIdEtudiant(): Collection
    {
        return $this->id_etudiant;
    }

    public function addIdEtudiant(Etudiant $idEtudiant): static
    {
        if (!$this->id_etudiant->contains($idEtudiant)) {
            $this->id_etudiant->add($idEtudiant);
            $idEtudiant->setIdClasse($this);
        }

        return $this;
    }

    public function removeIdEtudiant(Etudiant $idEtudiant): static
    {
        if ($this->id_etudiant->removeElement($idEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($idEtudiant->getIdClasse() === $this) {
                $idEtudiant->setIdClasse(null);
            }
        }

        return $this;
    }


}
