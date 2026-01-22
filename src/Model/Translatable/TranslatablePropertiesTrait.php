<?php declare(strict_types=1);

namespace Model\Translatable;

use Doctrine\Common\Collections\Collection;
use Contract\Entity\TranslationInterface;

/** @template Translation of TranslationInterface */
trait TranslatablePropertiesTrait
{
    /** @var Collection<string, Translation> */
    protected Collection $translations;

    /**
     * @see mergeNewTranslations
     *
     * @var Collection<string, Translation>
     */
    protected Collection $newTranslations;

    /** currentLocale is a non persisted field configured during postLoad event. */
    protected ?string $currentLocale;

    protected string $defaultLocale = 'nl';
}
