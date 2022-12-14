<?php

namespace FondOfSpryker\Yves\Router;

use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 */
class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    /**
     * @var string
     */
    public const DIRTY_STORE_INSTANCE = 'DIRTY_STORE_INSTANCE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addStore($container);

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
}
