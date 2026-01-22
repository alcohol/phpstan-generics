<?php declare(strict_types=1);

namespace Model\Translatable;

use Contract\Entity\TranslatableInterface;

/** @template Translatable of TranslatableInterface */
trait TranslationMethodsTrait
{
    /** @return class-string<Translatable> */
    public static function getTranslatableEntityClass(): string
    {
        return mb_substr(static::class, 0, -11);
    }

    /** @param Translatable $translatable */
    public function setTranslatable(TranslatableInterface $translatable): void
    {
        $this->translatable = $translatable;
    }

    /** @return Translatable */
    public function getTranslatable(): TranslatableInterface
    {
        return $this->translatable;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function isEmpty(): bool
    {
        foreach (get_object_vars($this) as $var => $value) {
            if (\in_array($var, ['id', 'translatable', 'locale'], true)) {
                continue;
            }

            if (\is_string($value) && \strlen(trim($value)) > 0) {
                return false;
            }

            if ( ! empty($value)) {
                return false;
            }
        }

        return true;
    }
}
