<?php declare(strict_types=1);

namespace Model\Translatable;

use Contract\Entity\TranslatableInterface;

/** @template Translatable of TranslatableInterface */
trait TranslationPropertiesTrait
{
    protected string $locale;

    /** @var ?Translatable */
    protected ?TranslatableInterface $translatable;
}
