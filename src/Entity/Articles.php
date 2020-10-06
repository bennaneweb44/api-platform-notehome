<?php

namespace App\Entity;

use App\Entity\Rayons;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
 
/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="articles_rayon_id_foreign", columns={"rayon_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 * 
 * @ApiResource(
 *      attributes={
 *          "order"={"createdAt":"DESC"},
 *      },      
 *      paginationItemsPerPage=3,
 *      collectionOperations={
 *          "get", "post"
 *      },
 *      itemOperations={
 *          "get", "patch", "delete"    
 *      },
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={"rayon": "exact"})
 */
class Articles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="modif_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $modifId = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var \Rayons
     *
     * @ORM\ManyToOne(targetEntity="Rayons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rayon_id", referencedColumnName="id")
     * })
     */
    private $rayon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getModifId(): ?int
    {
        return $this->modifId;
    }

    public function setModifId(int $modifId): self
    {
        $this->modifId = $modifId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getRayon(): ?Rayons
    {
        return $this->rayon;
    }

    public function setRayon(?Rayons $rayon): self
    {
        $this->rayon = $rayon;

        return $this;
    }


}
