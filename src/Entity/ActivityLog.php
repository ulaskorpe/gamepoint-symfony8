<?php

namespace App\Entity;

use App\Repository\ActivityLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityLogRepository::class)]
#[ORM\Table(name: 'activity_log')]
class ActivityLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private ?string $id = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $logName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $subjectType = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $event = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $causerType = null;

    /** @var array<string, mixed>|null */
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $properties = null;

    #[ORM\Column(length: 36, nullable: true)]
    private ?string $batchUuid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true, options: ['unsigned' => true])]
    private ?string $customerId = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLogName(): ?string
    {
        return $this->logName;
    }

    public function setLogName(?string $logName): static
    {
        $this->logName = $logName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSubjectType(): ?string
    {
        return $this->subjectType;
    }

    public function setSubjectType(?string $subjectType): static
    {
        $this->subjectType = $subjectType;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getCauserType(): ?string
    {
        return $this->causerType;
    }

    public function setCauserType(?string $causerType): static
    {
        $this->causerType = $causerType;

        return $this;
    }

    /** @return array<string, mixed>|null */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /** @param array<string, mixed>|null $properties */
    public function setProperties(?array $properties): static
    {
        $this->properties = $properties;

        return $this;
    }

    public function getBatchUuid(): ?string
    {
        return $this->batchUuid;
    }

    public function setBatchUuid(?string $batchUuid): static
    {
        $this->batchUuid = $batchUuid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(?string $customerId): static
    {
        $this->customerId = $customerId;

        return $this;
    }
}
