<?php declare(strict_types=1);

namespace Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Contract\Entity\TranslationInterface;
use Model\Translatable\TranslationTrait;

/** @implements TranslationInterface<Document> */
#[ORM\Entity]
class DocumentTranslation implements TranslationInterface
{
    /** @use TranslationTrait<Document> */
    use TranslationTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 245)]
    private string $contentTitle = '';

    #[ORM\Column(type: Types::TEXT)]
    private string $content = '';

    #[ORM\Column(type: Types::TEXT)]
    private string $shortDescription = '';

    public function getContentTitle(): string
    {
        return $this->contentTitle;
    }

    public function setContentTitle(string $contentTitle): self
    {
        $this->contentTitle = $contentTitle;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }
}
