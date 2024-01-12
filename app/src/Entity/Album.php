<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $albumName = null;

    #[ORM\Column(length: 255)]
    private ?string $albumArtist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbumName(): ?string
    {
        return $this->albumName;
    }

    public function setAlbumName(string $albumName): static
    {
        $this->albumName = $albumName;

        return $this;
    }

    public function getAlbumArtist(): ?string
    {
        return $this->albumArtist;
    }

    public function setAlbumArtist(string $albumArtist): static
    {
        $this->albumArtist = $albumArtist;

        return $this;
    }
}
