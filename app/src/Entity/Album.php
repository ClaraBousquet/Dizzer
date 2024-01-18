<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Artist; 

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $albumName = null;

    #[ORM\Column(length: 255)]
    private ?string $albumTitle = null;

        #[ORM\Column(length: 255)]
    private ?string $albumListTitres = null;

    #[ORM\Column(length: 255)]
    private ?string $albumType = null;

    #[ORM\ManyToOne(targetEntity: Artist::class, inversedBy: 'albums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbumName(): ?string
    {
        return $this->albumName;
    }

    public function setAlbumName(string $albumName): self
    {
        $this->albumName = $albumName;
        return $this;
    }

    public function getAlbumType(): ?string
    {
        return $this->albumType;
    }

    public function setAlbumType(string $albumType): self
    {
        $this->albumType = $albumType;
        return $this;
    }
   public function getAlbumTitle(): ?string
    {
        return $this->albumTitle;
    }

    public function setAlbumTitle(string $albumTitle): self
    {
        $this->albumTitle = $albumTitle;
        return $this;
    }

   public function getAlbumListTitres(): ?string
    {
        return $this->albumListTitres;
    }

 public function setAlbumListTitres(string $albumListTitres): self
{
    $this->albumListTitres = $albumListTitres;
    return $this;
}

    

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;
        return $this;
    }
}
