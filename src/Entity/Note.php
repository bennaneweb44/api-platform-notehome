<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['note:list', 'user:read', 'category:read']
            ],
        ],
        'get_by_category' => [
            'normalization_context' => [
                'groups' => 'note:list'
            ],
            'path' => '/notes/category/{id}',
            'method' => 'get'
        ],
        'get_by_user' => [
            'normalization_context' => [
                'groups' => 'note:list'
            ],
            'path' => '/notes/user/{id}',
            'method' => 'get'
        ],
        'get_by_type' => [
            'normalization_context' => [
                'groups' => 'note:list'
            ],
            'path' => '/notes/type/{type}',
            'method' => 'get'
        ],
        'post' => [
            'normalization_context' => [
                'groups' => ['note:list', 'user:read', 'category:read']
            ],
        ]
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['note:read', 'user:read', 'category:read'],
            ],
            'denormalization_context' => [
                'groups' => 'note:write'
            ],
        ],
        'put' => [
            'denormalization_context' => [
                'groups' => 'note:write'
            ],
        ],
        'delete'
    ],
    order: ["id" => "DESC"]
)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['note:list', 'note:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['note:list', 'note:read', 'note:write'])]
    private ?string $title = null;
    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['note:list', 'note:read', 'note:write'])]
    private ?string $content = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['note:list', 'note:read', 'note:write'])]
    private ?int $type = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[Groups(['note:list', 'note:read', 'user:read', 'note:write'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[Groups(['note:list', 'note:read', 'note:write', 'category:read'])]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'note', cascade: ['remove'], targetEntity: Element::class)]
    private Collection $elements;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Element>
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(Element $element): self
    {
        if (!$this->elements->contains($element)) {
            $this->elements->add($element);
            $element->setNote($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getNote() === $this) {
                $element->setNote(null);
            }
        }

        return $this;
    }
}
