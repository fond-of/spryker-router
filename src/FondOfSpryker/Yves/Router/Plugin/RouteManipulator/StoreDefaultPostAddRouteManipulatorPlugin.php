<?php

namespace FondOfSpryker\Yves\Router\Plugin\RouteManipulator;

use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\RouterExtension\Dependency\Plugin\PostAddRouteManipulatorPluginInterface;
use Symfony\Component\Routing\Route;

/**
 * @method \Spryker\Yves\Router\RouterConfig getConfig()
 * @method \FondOfSpryker\Yves\Router\RouterFactory getFactory()
 */
class StoreDefaultPostAddRouteManipulatorPlugin extends AbstractPlugin implements PostAddRouteManipulatorPluginInterface
{
    /**
     * @var string
     */
    protected $allowedLocalesPattern;

    /**
     * @param string $routeName
     * @param \Symfony\Component\Routing\Route $route
     *
     * @return \Symfony\Component\Routing\Route
     */
    public function manipulate(string $routeName, Route $route): Route
    {
        $route->setDefault('store', APPLICATION_STORE);

        return $route;
    }
}
