<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $artistName = null;

    #[ORM\ManyToMany(targetEntity: Music::class, inversedBy: 'artists')]
    private Collection $musics; 

    public function __construct()
    {
        $this->musics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(string $artistName): self
    {
        $this->artistName = $artistName;
        return $this;
    }

    /**
     * @return Collection<int, User
     */
 

    /**
     * @return Collection<int, Music
     */
    public function getMusics(): Collection
    {
        return $this->musics;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->musics->contains($music)) {
            $this->musics->add($music);
            $music->addArtist($this); 
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->musics->removeElement($music)) {
            $music->removeArtist($this); 

        return $this;
    }
}

}