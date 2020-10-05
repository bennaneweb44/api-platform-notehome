<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticlesNotes
 *
 * @ORM\Table(name="articles_notes", indexes={@ORM\Index(name="articles_notes_note_id_foreign", columns={"note_id"}), @ORM\Index(name="articles_notes_article_id_foreign", columns={"article_id"})})
 * @ORM\Entity
 */
class ArticlesNotes
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
     * @var int
     *
     * @ORM\Column(name="modif_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $modifId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="barre", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $barre = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $position = '0';

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
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Notes
     *
     * @ORM\ManyToOne(targetEntity="Notes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="note_id", referencedColumnName="id")
     * })
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBarre(): ?int
    {
        return $this->barre;
    }

    public function setBarre(int $barre): self
    {
        $this->barre = $barre;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

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

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getNote(): ?Notes
    {
        return $this->note;
    }

    public function setNote(?Notes $note): self
    {
        $this->note = $note;

        return $this;
    }


}
