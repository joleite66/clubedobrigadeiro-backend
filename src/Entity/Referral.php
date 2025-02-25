<?php

namespace App\Entity;

use App\Repository\ReferralRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferralRepository::class)]
#[ORM\Table(name: 'referrals')]
#[ORM\HasLifecycleCallbacks]
class Referral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $referrer = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $referred = null;

    #[ORM\Column(options: ['default' => 10])]
    private int $earnedPoints = 10;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getReferrer(): ?User
    {
        return $this->referrer;
    }

    public function setReferrer(User $referrer): static
    {
        $this->referrer = $referrer;

        return $this;
    }

    public function getReferred(): ?User
    {
        return $this->referred;
    }

    public function setReferred(User $referred): static
    {
        $this->referred = $referred;

        return $this;
    }

    public function getEarnedPoints(): int
    {
        return $this->earnedPoints;
    }

    public function setEarnedPoints(int $earnedPoints): static
    {
        $this->earnedPoints = $earnedPoints;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
}
