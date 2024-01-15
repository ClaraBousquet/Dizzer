<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicRepository::class)]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'playlistTracks')]
    private ?Playlist $playlist = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'music', targetEntity: artist::class)]
    private Collection $artist;

    #[ORM\Column(length: 255)]
    private ?string $son = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'musicArtist')]
    private Collection $artists;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, artist>
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(artist $artist): static
    {
        if (!$this->artist->contains($artist)) {
            $this->artist->add($artist);
            $artist->setMusic($this);
        }

        return $this;
    }

    public function removeArtist(artist $artist): static
    {
        if ($this->artist->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getMusic() === $this) {
                $artist->setMusic(null);
            }
        }

        return $this;
    }

    public function getSon(): ?string
    {
        return $this->son;
    }

    public function setSon(string $son): static
    {
        $this->son = $son;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }
}
