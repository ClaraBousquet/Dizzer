<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
#[ApiResource]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $playlistName = null;

    #[ORM\OneToMany(mappedBy: 'playlist', targetEntity: music::class)]
    private Collection $playlistTracks;

    public function __construct()
    {
        $this->playlistTracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPlaylistName(): ?string
    {
        return $this->playlistName;
    }

    public function setPlaylistName(string $playlistName): static
    {
        $this->playlistName = $playlistName;

        return $this;
    }

    /**
     * @return Collection<int, music>
     */
    public function getPlaylistTracks(): Collection
    {
        return $this->playlistTracks;
    }

    public function addPlaylistTrack(music $playlistTrack): static
    {
        if (!$this->playlistTracks->contains($playlistTrack)) {
            $this->playlistTracks->add($playlistTrack);
            $playlistTrack->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistTrack(music $playlistTrack): static
    {
        if ($this->playlistTracks->removeElement($playlistTrack)) {
            // set the owning side to null (unless already changed)
            if ($playlistTrack->getPlaylist() === $this) {
                $playlistTrack->setPlaylist(null);
            }
        }

        return $this;
    }
}
