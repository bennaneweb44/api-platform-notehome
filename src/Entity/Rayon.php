<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RayonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RayonRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'post'
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'rayon:read'
            ],
            'denormalization_context' => [
                'groups' => 'rayon:write'
            ],
        ],
        'put'
    ],
    order: ['nom' => 'ASC']
)]
class Rayon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['rayon:list', 'rayon:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['rayon:list', 'rayon:read'])]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'rayon', targetEntity: Element::class)]
    private Collection $elements;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

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
            $element->setRayon($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getRayon() === $this) {
                $element->setRayon(null);
            }
        }

        return $this;
    }
}
