<?php

namespace App\Entity;

use App\Entity\Artist; 
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AlbumRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
#[ApiResource]
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
    private ?array $albumListTitres = null;

    #[ORM\Column(length: 255)]
    private ?string $albumType = null;

    #[ORM\ManyToOne(targetEntity: Artist::class, inversedBy: 'albums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $images = null;

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

   public function getAlbumListTitres(): ?array
    {
        return $this->albumListTitres;
    }

 public function setAlbumListTitres(array $albumListTitres): self
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

 public function getArtistesList(): ?Artist
             {
                 return $this->artist;
             }

    public function setArtistesList(?Artist $artist): self
    {
        $this->artist = $artist;
        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): static
    {
        $this->images = $images;

        return $this;
    }




}
