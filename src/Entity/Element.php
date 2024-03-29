<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ElementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['element:list', 'rayon:read']
            ],
        ],
        'get_by_note' => [
            'normalization_context' => [
                'groups' => ['element:list', 'user:read', 'category:read', 'rayon:read']
            ],
            'path' => '/elements/note/{id}',
            'method' => 'get'
        ],
        'get_by_name_ac' => [
            'normalization_context' => [
                'groups' => ['element:autocomplete']
            ],
            'path' => '/elements/autocomplete/{start}',
            'method' => 'get'
        ],
        'post' => [
            'normalization_context' => [
                'groups' => ['element:list', 'note:read', 'user:read', 'category:read', 'rayon:read']
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['element:read', 'rayon:read']
            ],
            'denormalization_context' => [
                'groups' => 'element:write'
            ],
        ],
        'put' => [
            'normalization_context' => [
                'groups' => ['element:read', 'rayon:read', 'note:read', 'user:read', 'category:read']
            ],
        ],
        'delete'
    ],
)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['element:list', 'element:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['element:list', 'element:autocomplete', 'element:read', 'element:write'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['element:list', 'element:read', 'element:write'])]
    private ?string $photo = null;

    #[ORM\ManyToOne(inversedBy: 'elements')]
    private ?Note $note = null;

    #[ORM\Column]
    #[Groups(['element:list', 'element:read', 'element:write'])]
    private ?bool $barre = null;

    #[ORM\ManyToOne(inversedBy: 'elements')]
    #[Groups(['element:list', 'element:read', 'rayon:read', 'note:read'])]
    private ?Rayon $rayon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

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

    public function isBarre(): ?bool
    {
        return $this->barre;
    }

    public function setBarre(bool $barre): self
    {
        $this->barre = $barre;

        return $this;
    }

    public function getRayon(): ?Rayon
    {
        return $this->rayon;
    }

    public function setRayon(?Rayon $rayon): self
    {
        $this->rayon = $rayon;

        return $this;
    }
}
