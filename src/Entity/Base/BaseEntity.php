<?php
namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
abstract class BaseEntity
{
 

 protected ?string $slug = null;

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    // basit slug generator
    public function generateSlug(string $text): string
    {
        $slug = strtolower($text);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        return trim($slug, '-');
    }

}