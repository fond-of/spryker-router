<?php

namespace FondOfSpryker\Yves\Router\DataProvider;

use Spryker\Shared\Kernel\Store;

class StoreDataProvider implements DataProviderInterface
{
    /**
     * @var array
     */
    protected $availableLocales;

    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $storeInstance;

    /**
     * @param \Spryker\Shared\Kernel\Store $storeInstance
     */
    public function __construct(Store $storeInstance)
    {
        $this->storeInstance = $storeInstance;
    }

    /**
     * @return array
     */
    public function getAvailableLocales(): array
    {
        if ($this->availableLocales === null) {
            $this->availableLocales = $this->storeInstance->getLocales();
        }

        return $this->availableLocales;
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    public function getLanguageFromLocale(string $locale): ?string
    {
        return array_search($locale, $this->getAvailableLocales());
    }

    /**
     * @return string
     */
    public function getCurrentLanguage(): string
    {
        return $this->getLanguageFromLocale($this->storeInstance->getCurrentLocale());
    }
}
