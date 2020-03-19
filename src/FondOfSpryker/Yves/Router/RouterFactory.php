<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Yves\Router\Dependency\Client\RouterToSessionClientInterface;
use FondOfSpryker\Yves\Router\Dependency\Client\RouterToStoreClientInterface;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Sinergi\BrowserDetector\Language;
use Spryker\Yves\Router\RouterFactory as SprykerRouterFactory;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 */
class RouterFactory extends SprykerRouterFactory
{
    /**
     * @return \Sinergi\BrowserDetector\Language
     */
    public function createBrowserDetectorLanguage(): Language
    {
        return new Language();
    }

    /**
     * @return \Jaybizzle\CrawlerDetect\CrawlerDetect
     */
    public function createCrawlerDetect(): CrawlerDetect
    {
        return new CrawlerDetect();
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Client\RouterToSessionClientInterface
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSessionClient(): RouterToSessionClientInterface
    {
        return $this->getProvidedDependency(RouterDependencyProvider::CLIENT_SESSION);
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Client\RouterToStoreClientInterface
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getStoreClient(): RouterToStoreClientInterface
    {
        return $this->getProvidedDependency(RouterDependencyProvider::CLIENT_STORE);
    }
}
