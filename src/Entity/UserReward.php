<?php

namespace App\Entity;

use App\Repository\UserRewardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRewardRepository::class)]
#[ORM\Table(name: 'user_rewards')]
#[ORM\HasLifecycleCallbacks]
class UserReward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Reward::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Reward $reward = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $earnedAt = null;

    #[ORM\Column(length: 20, options: ['default' => 'pending'])]
    private string $status = 'pending';

    #[ORM\PrePersist]
    public function setEarnedAtValue(): void
    {
        if (!$this->earnedAt) {
            $this->earnedAt = new \DateTimeImmutable();
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getReward(): ?Reward
    {
        return $this->reward;
    }

    public function setReward(Reward $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getEarnedAt(): ?\DateTimeImmutable
    {
        return $this->earnedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
