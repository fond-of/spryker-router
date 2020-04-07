<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Yves\Router\Dependency\Client\RouterToSessionClientInterface;
use FondOfSpryker\Yves\Router\Dependency\Client\RouterToStoreClientInterface;
use FondOfSpryker\Yves\Router\RequestMatcher\SimpleRouterRequestMatcher;
use FondOfSpryker\Yves\Router\RouteEnhancer\SimpleRouterControllerRouteEnhancer;
use FondOfSpryker\Yves\Router\Router\SimpleRouter;
use FondOfSpryker\Yves\Router\UrlGenerator\SimpleRouterUrlGenerator;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Sinergi\BrowserDetector\Language;
use Spryker\Shared\Kernel\Store;
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
     * @return \Symfony\Cmf\Component\Routing\Enhancer\RouteEnhancerInterface[]
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createRouteEnhancer(): array
    {
        return [
            new SimpleRouterControllerRouteEnhancer($this->getSimpleRouterResourceCreatorPlugins()),
        ];
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

    /**
     * @return \Spryker\Shared\Kernel\Store
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getStoreInstance(): Store
    {
        return $this->getProvidedDependency(RouterDependencyProvider::DIRTY_STORE_INSTANCE);
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface[]
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSimpleRouterRequestMatcherPlugins(): array
    {
        return $this->getProvidedDependency(RouterDependencyProvider::PLUGIN_REQUEST_MATCHER_SIMPLE_ROUTER);
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface[]
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSimpleRouterResourceCreatorPlugins(): array
    {
        return $this->getProvidedDependency(RouterDependencyProvider::PLUGIN_RESOURCE_CREATORS_SIMPLE_ROUTER);
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Router\SimpleRouter
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createSimpleRouter(): SimpleRouter
    {
        return new SimpleRouter(
            $this->createSimpleRouterRequestMatcher(),
            $this->createSimpleRouterUrlGenerator(),
            $this->createRouteEnhancer()
        );
    }

    /**
     * @return \FondOfSpryker\Yves\Router\RequestMatcher\SimpleRouterRequestMatcher
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function createSimpleRouterRequestMatcher(): SimpleRouterRequestMatcher
    {
        return new SimpleRouterRequestMatcher($this->getSimpleRouterRequestMatcherPlugins());
    }

    /**
     * @return \FondOfSpryker\Yves\Router\UrlGenerator\SimpleRouterUrlGenerator
     */
    protected function createSimpleRouterUrlGenerator(): SimpleRouterUrlGenerator
    {
        return new SimpleRouterUrlGenerator();
    }
}
