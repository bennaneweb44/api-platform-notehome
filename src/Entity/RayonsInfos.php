<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RayonsInfos
 *
 * @ORM\Table(name="rayons_infos")
 * @ORM\Entity
 */
class RayonsInfos
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
     * @ORM\Column(name="rayon_id", type="integer", nullable=false)
     */
    private $rayonId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="note_id", type="integer", nullable=false)
     */
    private $noteId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="modif_id", type="integer", nullable=false)
     */
    private $modifId = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean", nullable=false)
     */
    private $checked = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false, options={"default"="1"})
     */
    private $position = '1';

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRayonId(): ?int
    {
        return $this->rayonId;
    }

    public function setRayonId(int $rayonId): self
    {
        $this->rayonId = $rayonId;

        return $this;
    }

    public function getNoteId(): ?int
    {
        return $this->noteId;
    }

    public function setNoteId(int $noteId): self
    {
        $this->noteId = $noteId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

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

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

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


}
