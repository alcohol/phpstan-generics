<?php declare(strict_types=1);

namespace Contract\Entity;

/** @template Translatable of TranslatableInterface */
interface TranslationInterface
{
    /** @return class-string<Translatable> */
    public static function getTranslatableEntityClass(): string;

    /** @param Translatable $translatable */
    public function setTranslatable(TranslatableInterface $translatable): void;

    /** @return Translatable */
    public function getTranslatable(): TranslatableInterface;

    public function setLocale(string $locale): void;

    public function getLocale(): string;

    public function isEmpty(): bool;
}
