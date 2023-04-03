<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Appartement')]
    private ?Lieu $lieu = null;

    #[ORM\ManyToMany(targetEntity: Critere::class, mappedBy: 'appartement')]
    private Collection $criteres;

    #[ORM\OneToMany(mappedBy: 'appartement', targetEntity: Lieu::class)]
    private Collection $lieux;

    #[ORM\Column(length: 150)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $Lien_image = null;

    #[ORM\Column]
    private ?float $prix = null;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
        $this->lieux = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Critere>
     */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Critere $critere): self
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres->add($critere);
            $critere->addAppartement($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): self
    {
        if ($this->criteres->removeElement($critere)) {
            $critere->removeAppartement($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Lieu>
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux->add($lieux);
            $lieux->setAppartement($this);
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): self
    {
        if ($this->lieux->removeElement($lieux)) {
            // set the owning side to null (unless already changed)
            if ($lieux->getAppartement() === $this) {
                $lieux->setAppartement(null);
            }
        }

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLienImage(): ?string
    {
        return $this->Lien_image;
    }

    public function setLienImage(string $Lien_image): self
    {
        $this->Lien_image = $Lien_image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }




}
