<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Yves\Router\DataProvider\DataProviderInterface;
use FondOfSpryker\Yves\Router\DataProvider\StoreDataProvider;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Router\RouterFactory as SprykerRouterFactory;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 */
class RouterFactory extends SprykerRouterFactory
{
    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStoreInstance(): Store
    {
        return $this->getProvidedDependency(RouterDependencyProvider::DIRTY_STORE_INSTANCE);
    }

    /**
     * @return \FondOfSpryker\Yves\Router\DataProvider\DataProviderInterface
     */
    public function createStoreDataProvider(): DataProviderInterface
    {
        return new StoreDataProvider($this->getStoreInstance());
    }
}
