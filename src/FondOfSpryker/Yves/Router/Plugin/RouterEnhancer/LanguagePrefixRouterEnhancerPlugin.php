<?php

namespace FondOfSpryker\Yves\Router\Plugin\RouterEnhancer;

use Spryker\Yves\Router\Plugin\RouterEnhancer\LanguagePrefixRouterEnhancerPlugin as SprykerLanguagePrefixRouterEnhancerPlugin;
use Symfony\Component\Routing\RequestContext;

/**
 * @method \FondOfSpryker\Yves\Router\RouterConfig getConfig()
 * @method \FondOfSpryker\Yves\Router\RouterFactory getFactory()
 */
class LanguagePrefixRouterEnhancerPlugin extends SprykerLanguagePrefixRouterEnhancerPlugin
{
    /**
     * @var array
     */
    protected $availableLocales;

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLanguageFromLocale(string $locale): string
    {
        $language = array_search($locale, $this->getAvailableLocales());

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
        $availableLocales = $this->getAvailableLocales();
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
     * @return array
     */
    protected function getAvailableLocales(): array
    {
        if ($this->availableLocales === null) {
            $this->availableLocales = $this->getFactory()->getStoreInstance()->getLocales();
        }

        return $this->availableLocales;
    }
}
