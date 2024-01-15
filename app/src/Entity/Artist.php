<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $artistName = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: user::class)]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: music::class, inversedBy: 'artists')]
    private Collection $music;

    public function __construct()
    {
        $this->music = new ArrayCollection();
    }

    #[ORM\ManyToOne(inversedBy: 'artist')]
    #[ORM\JoinColumn(nullable: false)]


  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(string $artistName): static
    {
        $this->artistName = $artistName;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(user $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setArtist($this);
        }

        return $this;
    }

    public function removeUser(user $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getArtist() === $this) {
                $user->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, music>
     */

    /**
     * @return Collection<int, music>
     */
    public function getMusic(): Collection
    {
        return $this->music;
    }

    public function addMusic(music $music): static
    {
        if (!$this->music->contains($music)) {
            $this->music->add($music);
        }

        return $this;
    }

    public function removeMusic(music $music): static
    {
        $this->music->removeElement($music);

        return $this;
    }


}
