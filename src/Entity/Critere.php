<?php

namespace App\Entity;

use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritereRepository::class)]
class Critere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Appartement::class, inversedBy: 'criteres')]
    private Collection $appartement;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    public function __toString()
    {
        return $this->libelle . ' (' . $this->appartement . ', ' . $this->libelle . ')';
    }

    public function __construct()
    {
        $this->appartement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartement(): Collection
    {
        return $this->appartement;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->appartement->contains($appartement)) {
            $this->appartement->add($appartement);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self
    {
        $this->appartement->removeElement($appartement);

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
