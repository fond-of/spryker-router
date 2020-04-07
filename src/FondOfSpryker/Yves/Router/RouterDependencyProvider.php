<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Yves\Router\Dependency\Client\RouterToSessionClientBridge;
use FondOfSpryker\Yves\Router\Dependency\Client\RouterToStoreClientBridge;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;
use Spryker\Yves\Kernel\Container;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 */
class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    public const CLIENT_SESSION = 'CLIENT_SESSION';
    public const CLIENT_STORE = 'CLIENT_STORE';
    public const DIRTY_STORE_INSTANCE = 'DIRTY_STORE_INSTANCE';
    public const PLUGIN_REQUEST_MATCHER_SIMPLE_ROUTER = 'PLUGIN_REQUEST_MATCHER_SIMPLE_ROUTER';
    public const PLUGIN_RESOURCE_CREATORS_SIMPLE_ROUTER = 'PLUGIN_RESOURCE_CREATORS_SIMPLE_ROUTER';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addSessionClient($container);
        $container = $this->addStoreClient($container);
        $container = $this->addStore($container);
        $container = $this->addSimpleRouterRequestMatcherPlugins($container);
        $container = $this->addSimpleRouterResourceCreatorPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSessionClient(Container $container): Container
    {
        $container[static::CLIENT_SESSION] = function (Container $container) {
            return new RouterToSessionClientBridge($container->getLocator()->session()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container[static::CLIENT_STORE] = function (Container $container) {
            return new RouterToStoreClientBridge($container->getLocator()->store()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStore(Container $container): Container
    {
        $container[static::DIRTY_STORE_INSTANCE] = function () {
            return Store::getInstance();
        };

        return $container;
    }

    /**
     * @param  \Spryker\Yves\Kernel\Container  $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSimpleRouterRequestMatcherPlugins(Container $container): Container
    {
        $container[static::PLUGIN_REQUEST_MATCHER_SIMPLE_ROUTER] = function () {
            return $this->getRequestMatcherPluginsSimpleRouter();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface[]
     */
    protected function getRequestMatcherPluginsSimpleRouter(): array
    {
        return [];
    }

    /**
     * @param  \Spryker\Yves\Kernel\Container  $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSimpleRouterResourceCreatorPlugins(Container $container): Container
    {
        $container[static::PLUGIN_RESOURCE_CREATORS_SIMPLE_ROUTER] = function () {
            return $this->getSimpleRouterResourceCreatorPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreator\ResourceCreatorPluginInterface[]
     */
    protected function getSimpleRouterResourceCreatorPlugins()
    {
        return [];
    }
}
