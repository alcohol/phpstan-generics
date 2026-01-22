<?php declare(strict_types=1);

namespace Model\Translatable;

use Contract\Entity\TranslatableInterface;

/** @template Translatable of TranslatableInterface */
trait TranslationTrait
{
    /** @use TranslationPropertiesTrait<Translatable> */
    use TranslationPropertiesTrait;

    /** @use TranslationMethodsTrait<Translatable> */
    use TranslationMethodsTrait;
}
