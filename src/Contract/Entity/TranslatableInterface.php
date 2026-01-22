<?php declare(strict_types=1);

namespace Contract\Entity;

use Doctrine\Common\Collections\Collection;

/** @template Translation of TranslationInterface */
interface TranslatableInterface
{
    /** @return Collection<string, Translation> */
    public function getTranslations(): Collection;

    /** @return Collection<string, Translation> */
    public function getNewTranslations(): Collection;

    /** @param Translation $translation */
    public function addTranslation(TranslationInterface $translation): void;

    /** @param Translation $translation */
    public function removeTranslation(TranslationInterface $translation): void;

    /** @return Translation */
    public function translate(?string $locale = null, bool $fallbackToDefault = true): TranslationInterface;

    public function mergeNewTranslations(): void;

    public function setCurrentLocale(string $locale): void;

    public function getCurrentLocale(): string;

    public function setDefaultLocale(string $locale): void;

    public function getDefaultLocale(): string;

    /** @return class-string<Translation> */
    public static function getTranslationEntityClass(): string;
}
