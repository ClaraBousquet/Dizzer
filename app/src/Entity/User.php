<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $userBirthday = null;

    #[ORM\Column]
    private ?bool $userAccount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserBirthday(): ?\DateTimeInterface
    {
        return $this->userBirthday;
    }

    public function setUserBirthday(\DateTimeInterface $userBirthday): static
    {
        $this->userBirthday = $userBirthday;

        return $this;
    }

    public function isUserAccount(): ?bool
    {
        return $this->userAccount;
    }

    public function setUserAccount(bool $userAccount): static
    {
        $this->userAccount = $userAccount;

        return $this;
    }
}
