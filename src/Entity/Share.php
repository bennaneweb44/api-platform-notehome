<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ShareRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ShareRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['share:list', 'user:read', 'note:read']
            ],
        ],
        'get_updated_shares_of_user' => [
            'normalization_context' => [
                'groups' => ['share:list', 'user:read', 'note:read']
            ],
            'path' => '/shares/updated/user/{id}',
            'method' => 'get'
        ],
        'post'
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['share:read']
            ],
            'denormalization_context' => [
                'groups' => 'share:write'
            ],
        ],
        'put',
        'delete'
    ],
)]
class Share
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['share:list', 'share:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shares')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['share:list', 'share:read', 'share:write'])]
    private ?User $user_1 = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['share:list', 'share:read', 'share:write'])]
    private ?User $user_2 = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['share:list', 'share:read', 'share:write'])]
    private ?Note $note = null;

    #[ORM\Column]
    #[Groups(['share:list', 'share:read', 'share:write'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    #[Groups(['share:list', 'share:read', 'share:write'])]
    private ?bool $seen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser1(): ?User
    {
        return $this->user_1;
    }

    public function setUser1(?User $user_1): self
    {
        $this->user_1 = $user_1;

        return $this;
    }

    public function getUser2(): ?User
    {
        return $this->user_2;
    }

    public function setUser2(?User $user_2): self
    {
        $this->user_2 = $user_2;

        return $this;
    }

    public function getNote(): ?Note
    {
        return $this->note;
    }

    public function setNote(?Note $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }
}
