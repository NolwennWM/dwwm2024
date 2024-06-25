<?php 
namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait TimeStampTrait
{
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $editedAt = null;
    
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(?\DateTimeInterface $editedAt): static
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    #[ORM\PreUpdate()]
    public function onPreUpdate()
    {
        $this->editedAt = new \DateTime();
    }

    #[ORM\PrePersist()]
    public function onPrePersist()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}