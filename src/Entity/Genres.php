<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'genres', targetEntity: Chansons::class)]
    private Collection $chansons;

    public function __construct()
    {
        $this->chansons = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Chansons>
     */
    public function getChansons(): Collection
    {
        return $this->chansons;
    }

    public function addChanson(Chansons $chanson): self
    {
        if (!$this->chansons->contains($chanson)) {
            $this->chansons->add($chanson);
            $chanson->setGenres($this);
        }

        return $this;
    }

    public function removeChanson(Chansons $chanson): self
    {
        if ($this->chansons->removeElement($chanson)) {
            // set the owning side to null (unless already changed)
            if ($chanson->getGenres() === $this) {
                $chanson->setGenres(null);
            }
        }

        return $this;
    }
    public function __toString() : string
    {
        return $this-> getTitre();
    }
}
