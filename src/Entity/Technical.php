<?php

namespace App\Entity;

use App\Repository\TechnicalRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Base\BaseEntity;
// Gedmo: soft delete (deletedAt), zaman damgaları (trait içindeki alanlar); hardDelete false = ikinci remove fiziksel silme yapmaz
#[ORM\Entity(repositoryClass: TechnicalRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', hardDelete: false)]
class Technical extends BaseEntity
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Gedmo\Slug(fields: ['title'])]
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'tech.validation.title_not_blank')]
    #[Assert\Length(max: 255, maxMessage: 'tech.validation.title_max')]
    private ?string $title = null;
    #[Gedmo\Slug(fields: ['title'])]

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 20000, maxMessage: 'tech.validation.description_max')]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 100000, maxMessage: 'tech.validation.code_max')]
    private ?string $code = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
