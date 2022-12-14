<?php

namespace FondOfSpryker\Yves\Router\DataProvider;

interface DataProviderInterface
{
    /**
     * @return array
     */
    public function getAvailableLocales(): array;

    /**
     * @param string $locale
     *
     * @return string|null
     */
    public function getLanguageFromLocale(string $locale): ?string;

    /**
     * @return string
     */
    public function getCurrentLanguage(): string;
}
