<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'lieu', targetEntity: Appartement::class)]
    private Collection $Appartement;

    #[ORM\Column(length: 5)]
    private ?string $codepostal = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\ManyToOne(inversedBy: 'lieux')]
    private ?Appartement $appartement = null;

    public function __construct()
    {
        $this->Appartement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->adresse . ' (' . $this->adresse . ', ' . $this->codepostal . ' ' . $this->ville . ')';
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartement(): Collection
    {
        return $this->Appartement;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->Appartement->contains($appartement)) {
            $this->Appartement->add($appartement);
            $appartement->setLieu($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self
    {
        if (    $this->Appartement->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getLieu() === $this) {
                $appartement->setLieu(null);
            }
        }

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setAppartement(?Appartement $appartement): self
    {
        $this->appartement = $appartement;

        return $this;
    }
}
