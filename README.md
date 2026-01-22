```shell
# with 2.1.33

$ php vendor/bin/phpstan
Note: Using configuration file /workdir/phpstan.dist.neon.
 11/11 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ -----------------------------------------------------------------------------------
  Line   Entity/Document.php
 ------ -----------------------------------------------------------------------------------
  20     Property Entity\Document::$id is never written, only read.
         🪪  property.onlyRead
         💡  See: https://phpstan.org/developing-extensions/always-read-written-properties
 ------ -----------------------------------------------------------------------------------

 ------ -----------------------------------------------------------------------------------
  Line   Entity/DocumentTranslation.php
 ------ -----------------------------------------------------------------------------------
  20     Property Entity\DocumentTranslation::$id is never written, only read.
         🪪  property.onlyRead
         💡  See: https://phpstan.org/developing-extensions/always-read-written-properties
 ------ -----------------------------------------------------------------------------------


 [ERROR] Found 2 errors

# upgrade to latest
$ composer require --dev phpstan/phpstan ^2

...

# with 2.1.36

$ php vendor/bin/phpstan
Note: Using configuration file /workdir/phpstan.dist.neon.
 11/11 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------
  Line   Entity/Document.php
 ------ ------------------------------------------------------------------------------------------
  20     Property Entity\Document::$id is never written, only read.
         🪪  property.onlyRead
         💡  See: https://phpstan.org/developing-extensions/always-read-written-properties
  44     Call to an undefined method Contract\Entity\TranslationInterface::setContentTitle().
         🪪  method.notFound
  51     Call to an undefined method Contract\Entity\TranslationInterface::getContentTitle().
         🪪  method.notFound
  56     Call to an undefined method Contract\Entity\TranslationInterface::setContent().
         🪪  method.notFound
  63     Call to an undefined method Contract\Entity\TranslationInterface::getContent().
         🪪  method.notFound
  68     Call to an undefined method Contract\Entity\TranslationInterface::getShortDescription().
         🪪  method.notFound
  73     Call to an undefined method Contract\Entity\TranslationInterface::setShortDescription().
         🪪  method.notFound
 ------ ------------------------------------------------------------------------------------------

 ------ -----------------------------------------------------------------------------------
  Line   Entity/DocumentTranslation.php
 ------ -----------------------------------------------------------------------------------
  20     Property Entity\DocumentTranslation::$id is never written, only read.
         🪪  property.onlyRead
         💡  See: https://phpstan.org/developing-extensions/always-read-written-properties
 ------ -----------------------------------------------------------------------------------

 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Line   Model/Translatable/TranslatableMethodsTrait.php (in context of class Entity\Document)
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  15     Method Entity\Document::getTranslations() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  15     Return type (Doctrine\Common\Collections\Collection<string, Contract\Entity\TranslationInterface>) of method Entity\Document::getTranslations() should be compatible with return type (Doctrine\Common\Collections\Collection<string, Entity\DocumentTranslation>) of method Contract\Entity\TranslatableInterface<Entity\DocumentTranslation>::getTranslations()
         🪪  method.childReturnType
  29     Method Entity\Document::setTranslations() has parameter $translations with generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  39     Method Entity\Document::getNewTranslations() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  39     Return type (Doctrine\Common\Collections\Collection<string, Contract\Entity\TranslationInterface>) of method Entity\Document::getNewTranslations() should be compatible with return type (Doctrine\Common\Collections\Collection<string, Entity\DocumentTranslation>) of method Contract\Entity\TranslatableInterface<Entity\DocumentTranslation>::getNewTranslations()
         🪪  method.childReturnType
  49     Method Entity\Document::addTranslation() has parameter $translation with generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  57     Method Entity\Document::removeTranslation() has parameter $translation with generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  63     Method Entity\Document::translate() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  117    Method Entity\Document::getTranslationEntityClass() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  123    Method Entity\Document::doTranslate() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  150    PHPDoc tag @var for variable $translation contains generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  173    PHPDoc tag @var for variable $translation contains generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  179    Method Entity\Document::findTranslationByLocale() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  208    Method Entity\Document::ensureIsIterableOrCollection() has parameter $translations with generic interface Contract\Entity\TranslationInterface but does not specify its types: Translatable
         🪪  missingType.generics
  224    Method Entity\Document::resolveFallbackTranslation() return type with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

 ------ -------------------------------------------------------------------------------------------------------------------------------------------------
  Line   Model/Translatable/TranslatablePropertiesTrait.php (in context of class Entity\Document)
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------
  12     Property Entity\Document::$translations with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
  19     Property Entity\Document::$newTranslations with generic interface Contract\Entity\TranslationInterface does not specify its types: Translatable
         🪪  missingType.generics
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------

 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Line   Model/Translatable/TranslationMethodsTrait.php (in context of class Entity\DocumentTranslation)
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  11     Method Entity\DocumentTranslation::getTranslatableEntityClass() return type with generic interface Contract\Entity\TranslatableInterface does not specify its types: Translation
         🪪  missingType.generics
  17     Method Entity\DocumentTranslation::setTranslatable() has parameter $translatable with generic interface Contract\Entity\TranslatableInterface but does not specify its types: Translation
         🪪  missingType.generics
  23     Method Entity\DocumentTranslation::getTranslatable() return type with generic interface Contract\Entity\TranslatableInterface does not specify its types: Translation
         🪪  missingType.generics
 ------ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

 ------ ---------------------------------------------------------------------------------------------------------------------------------------------------------
  Line   Model/Translatable/TranslationPropertiesTrait.php (in context of class Entity\DocumentTranslation)
 ------ ---------------------------------------------------------------------------------------------------------------------------------------------------------
  13     Property Entity\DocumentTranslation::$translatable with generic interface Contract\Entity\TranslatableInterface does not specify its types: Translation
         🪪  missingType.generics
 ------ ---------------------------------------------------------------------------------------------------------------------------------------------------------


 [ERROR] Found 29 errors

```
