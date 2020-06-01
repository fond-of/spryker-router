<?php

namespace FondOfSpryker\Yves\Router\Plugin\RouterEnhancer;

use FondOfSpryker\Yves\Router\DataProvider\DataProviderInterface;
use Spryker\Yves\Router\Plugin\RouterEnhancer\LanguagePrefixRouterEnhancerPlugin as SprykerLanguagePrefixRouterEnhancerPlugin;
use Symfony\Component\Routing\RequestContext;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 * @method \FondOfSpryker\Yves\Router\RouterFactory getFactory()
 */
class LanguagePrefixRouterEnhancerPlugin extends SprykerLanguagePrefixRouterEnhancerPlugin
{
    protected $storeDataProvder;

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLanguageFromLocale(string $locale): string
    {
        $language = $this->getStoreDataProvider()->getLanguageFromLocale($locale);

        if ($language === null) {
            $language = parent::getLanguageFromLocale($locale);
        }

        return $language;
    }

    /**
     * @param \Symfony\Component\Routing\RequestContext $requestContext
     *
     * @return string|null
     */
    protected function findLanguage(RequestContext $requestContext): ?string
    {
        $language = parent::findLanguage($requestContext);
        $availableLocales = $this->getStoreDataProvider()->getAvailableLocales();
        if (!array_key_exists($language, $availableLocales)) {
            foreach ($availableLocales as $lang => $locale) {
                if (substr($locale, 0, strlen($language)) === $language) {
                    $language = $lang;

                    break;
                }
            }
        }

        return $language;
    }

    /**
     * @return \FondOfSpryker\Yves\Router\DataProvider\DataProviderInterface
     */
    protected function getStoreDataProvider(): DataProviderInterface
    {
        if ($this->storeDataProvder === null) {
            $this->storeDataProvder = $this->getFactory()->createStoreDataProvider();
        }

        return $this->storeDataProvder;
    }
}
