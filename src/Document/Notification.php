<?php

namespace App\Document;

use App\Repository\NotificationRepository;
use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;
use Doctrine\ODM\MongoDB\Mapping\Attribute\TimeSeries;
use Doctrine\ODM\MongoDB\Mapping\TimeSeries\Granularity;
use Doctrine\ODM\MongoDB\Types\Type;
use MongoDB\BSON\ObjectId;

#[ODM\Document(collection: 'notifications', repositoryClass: NotificationRepository::class)]
#[TimeSeries(timeField: 'created_at', metaField: 'user_id', granularity: Granularity::Seconds)]
class Notification
{
    #[ODM\Id]
    private ?string $id = null;

    #[ODM\Field(type: Type::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $created_at = null;

    #[ODM\Field(type: Type::INT)]
    private ?int $user_id = null;

    #[ODM\Field(type: Type::STRING, nullable: true)]
    private ?string $type = null;

    #[ODM\Field(type: Type::STRING)]
    private ?string $title = null;

    #[ODM\Field(type: Type::STRING, nullable: true)]
    private ?string $message = null;

    #[ODM\Field(type: Type::BOOL)]
    private bool $read = false;

    /** @var array<string, mixed>|null */
    #[ODM\Field(type: Type::HASH, nullable: true)]
    private ?array $data = null;

    #[ODM\Field(type: Type::DATE_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $updated_at = null;

    public function __construct(int $userId, string $title, ?string $message = null, ?string $type = null)
    {
        $this->id = (string) new ObjectId();
        $this->user_id = $userId;
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): static
    {
        $this->user_id = $userId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function isRead(): bool
    {
        return $this->read;
    }

    public function setRead(bool $read): static
    {
        $this->read = $read;

        return $this;
    }

    /** @return array<string, mixed>|null */
    public function getData(): ?array
    {
        return $this->data;
    }

    /** @param array<string, mixed>|null $data */
    public function setData(?array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): static
    {
        $this->updated_at = $updatedAt;

        return $this;
    }
}
