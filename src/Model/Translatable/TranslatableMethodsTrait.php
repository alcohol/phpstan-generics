<?php declare(strict_types=1);

namespace Model\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\Proxy;
use Contract\Entity\TranslationInterface;
use Exception\TranslatableException;

/** @template Translation of TranslationInterface */
trait TranslatableMethodsTrait
{
    /** @return Collection<string, Translation> */
    public function getTranslations(): Collection
    {
        if ( ! isset($this->translations)) {
            $this->translations = new ArrayCollection();
        }

        return $this->translations;
    }

    /**
     * @param Collection<string, Translation>|iterable<Translation> $translations
     *
     * @throws TranslatableException
     */
    public function setTranslations(iterable $translations): void
    {
        $this->ensureIsIterableOrCollection($translations);

        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
    }

    /** @return Collection<string, Translation> */
    public function getNewTranslations(): Collection
    {
        if ( ! isset($this->newTranslations)) {
            $this->newTranslations = new ArrayCollection();
        }

        return $this->newTranslations;
    }

    /** @param Translation $translation */
    public function addTranslation(TranslationInterface $translation): void
    {
        $this->getTranslations()->set($translation->getLocale(), $translation);

        $translation->setTranslatable($this);
    }

    /** @param Translation $translation */
    public function removeTranslation(TranslationInterface $translation): void
    {
        $this->getTranslations()->removeElement($translation);
    }

    /** @return Translation */
    public function translate(?string $locale = null, bool $fallbackToDefault = true): TranslationInterface
    {
        return $this->doTranslate($locale, $fallbackToDefault);
    }

    public function mergeNewTranslations(): void
    {
        foreach ($this->getNewTranslations() as $newTranslation) {
            if ( ! $this->getTranslations()->contains($newTranslation) && ! $newTranslation->isEmpty()) {
                $this->addTranslation($newTranslation);
                $this->getNewTranslations()->removeElement($newTranslation);
            }
        }

        foreach ($this->getTranslations() as $translation) {
            if ( ! $translation->isEmpty()) {
                continue;
            }

            $this->removeTranslation($translation);
        }
    }

    public function setCurrentLocale(string $locale): void
    {
        $this->currentLocale = $locale;
    }

    public function getCurrentLocale(): string
    {
        // @see https://github.com/KnpLabs/DoctrineBehaviors/pull/767
        if ($this instanceof Proxy && ! $this->__isInitialized()) {
            $this->__load();
        }

        return $this->currentLocale ?? $this->getDefaultLocale();
    }

    public function setDefaultLocale(string $locale): void
    {
        // @see https://github.com/KnpLabs/DoctrineBehaviors/pull/767
        if ($this instanceof Proxy && ! $this->__isInitialized()) {
            $this->__load();
        }

        $this->defaultLocale = $locale;
    }

    public function getDefaultLocale(): string
    {
        return $this->defaultLocale;
    }

    /** @return class-string<Translation> */
    public static function getTranslationEntityClass(): string
    {
        return static::class.'Translation';
    }

    /** @return Translation */
    protected function doTranslate(?string $locale = null, bool $fallbackToDefault = true): TranslationInterface
    {
        if (null === $locale) {
            $locale = $this->getCurrentLocale();
        }

        $foundTranslation = $this->findTranslationByLocale($locale);

        if ($foundTranslation && ! $foundTranslation->isEmpty()) {
            return $foundTranslation;
        }

        if ($fallbackToDefault) {
            $fallbackTranslation = $this->resolveFallbackTranslation($locale);

            if (null !== $fallbackTranslation) {
                return $fallbackTranslation;
            }
        }

        if ($foundTranslation) {
            return $foundTranslation;
        }

        $translationEntityClass = static::getTranslationEntityClass();

        /** @var Translation $translation */
        $translation = new $translationEntityClass();
        $translation->setLocale($locale);

        $this->getNewTranslations()->set($translation->getLocale(), $translation);

        $translation->setTranslatable($this);

        return $translation;
    }

    /**
     * @param mixed[] $arguments
     *
     * @return mixed The translated value of the field for current locale
     */
    protected function proxyCurrentLocaleTranslation(string $method, array $arguments = []): mixed
    {
        // allow $entity->name call $entity->getName() in templates
        if ( ! method_exists(self::getTranslationEntityClass(), $method)) {
            $method = 'get'.ucfirst($method);
        }

        /** @var Translation $translation */
        $translation = $this->translate($this->getCurrentLocale());

        return \call_user_func_array([$translation, $method], $arguments);
    }

    /** @return Translation|null */
    protected function findTranslationByLocale(string $locale, bool $withNewTranslations = true): ?TranslationInterface
    {
        $translation = $this->getTranslations()->get($locale);

        if ($translation) {
            return $translation;
        }

        if ($withNewTranslations) {
            return $this->getNewTranslations()->get($locale);
        }

        return null;
    }

    protected function computeFallbackLocale(string $locale): ?string
    {
        if (false !== strrchr($locale, '_')) {
            return substr($locale, 0, -\strlen(strrchr($locale, '_')));
        }

        return null;
    }

    /**
     * @param Collection<string, Translation>|iterable<Translation> $translations
     *
     * @throws TranslatableException
     */
    private function ensureIsIterableOrCollection(mixed $translations): void
    {
        if ($translations instanceof Collection) {
            return;
        }

        if (is_iterable($translations)) {
            return;
        }

        throw new TranslatableException(
            \sprintf('$translations parameter must be iterable or %s', Collection::class),
        );
    }

    /** @return Translation|null */
    private function resolveFallbackTranslation(string $locale): ?TranslationInterface
    {
        $fallbackLocale = $this->computeFallbackLocale($locale);

        if (null !== $fallbackLocale) {
            $translation = $this->findTranslationByLocale($fallbackLocale);

            if ($translation && ! $translation->isEmpty()) {
                return $translation;
            }
        }

        return $this->findTranslationByLocale($this->getDefaultLocale(), false);
    }
}
