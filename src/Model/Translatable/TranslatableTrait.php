<?php declare(strict_types=1);

namespace Model\Translatable;

use Contract\Entity\TranslationInterface;

/** @template Translation of TranslationInterface */
trait TranslatableTrait
{
    /** @use TranslatablePropertiesTrait<Translation> */
    use TranslatablePropertiesTrait;

    /** @use TranslatableMethodsTrait<Translation> */
    use TranslatableMethodsTrait;
}
