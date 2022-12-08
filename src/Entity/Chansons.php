<?php

namespace App\Entity;

use App\Repository\ChansonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChansonsRepository::class)]
class Chansons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $artiste = null;

    #[ORM\Column(length: 255)]
    private ?string $album = null;

    #[ORM\Column]
    private ?int $votes = 0;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $paroles = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAjout = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\ManyToOne(inversedBy: 'chansons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genres $genres = null;

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

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }


    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(string $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getVotes(): ?string
    {
        return $this->votes;
    }

    public function setVotes(string $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    public function getParoles(): ?string
    {
        return $this->paroles;
    }

    public function setParoles(string $paroles): self
    {
        $this->paroles = $paroles;

        return $this;
    }



    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getGenres(): ?Genres
    {
        return $this->genres;
    }

    public function setGenres(?Genres $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

}
