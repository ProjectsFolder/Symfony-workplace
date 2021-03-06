<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @Vich\Uploadable
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2500)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tasks")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $attachment;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $attachmentFileName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="task_file", fileNameProperty="attachment", originalName="attachmentFileName")
     * @var File
     */
    private $attachmentFile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TaskAdditionalData", mappedBy="task", cascade={"persist", "remove"})
     */
    private $additionalData;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $imageFileName;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "Максимальный размер изображения составляет 5 мегабайт.",
     *     mimeTypesMessage = "Необходимо загрузить изображение."
     * )
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image", originalName="imageFileName")
     * @var File
     */
    private $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

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

    public function __toString()
    {
        return $this->description;
    }

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function setAttachment(?string $attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function getAttachmentFileName(): ?string
    {
        return $this->attachmentFileName;
    }

    public function setAttachmentFileName(?string $attachmentFileName): self
    {
        $this->attachmentFileName = $attachmentFileName;

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

    public function getAttachmentFile(): ?File
    {
        return $this->attachmentFile;
    }

    public function setAttachmentFile(?File $attachmentFile = null): void
    {
        $this->attachmentFile = $attachmentFile;

        if (null !== $attachmentFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getAdditionalData(): ?TaskAdditionalData
    {
        return $this->additionalData;
    }

    public function setAdditionalData(?TaskAdditionalData $additionalData): self
    {
        $this->additionalData = $additionalData;

        // set the owning side of the relation if necessary
        if (null != $additionalData && $this !== $additionalData->getTask()) {
            $additionalData->setTask($this);
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(?string $imageFileName): self
    {
        $this->imageFileName = $imageFileName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
}
