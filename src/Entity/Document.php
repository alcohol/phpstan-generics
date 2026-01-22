<?php declare(strict_types=1);

namespace Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Contract\Entity\TranslatableInterface;
use Model\Translatable\TranslatableTrait;

/** @implements TranslatableInterface<DocumentTranslation> */
#[ORM\Entity]
class Document implements TranslatableInterface
{
    /** @use TranslatableTrait<DocumentTranslation> */
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::SMALLINT)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 245)]
    private string $title;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title ?? null;
    }

    public function setContentTitle(string $content): self
    {
        $this->translate()->setContentTitle($content);

        return $this;
    }

    public function getContentTitle(): ?string
    {
        return $this->translate()->getContentTitle();
    }

    public function setContent(string $content): self
    {
        $this->translate()->setContent($content);

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->translate()->getContent();
    }

    public function getShortDescription(): ?string
    {
        return $this->translate()->getShortDescription();
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->translate()->setShortDescription($shortDescription);

        return $this;
    }
}
