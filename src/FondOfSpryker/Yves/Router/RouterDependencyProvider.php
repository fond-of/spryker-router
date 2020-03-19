<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Yves\Router\Dependency\Client\RouterToSessionClientBridge;
use FondOfSpryker\Yves\Router\Dependency\Client\RouterToStoreClientBridge;
use Spryker\Yves\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;
use Spryker\Yves\Kernel\Container;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 */
class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    public const CLIENT_SESSION = 'CLIENT_SESSION';
    public const CLIENT_STORE = 'CLIENT_STORE';

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
}
