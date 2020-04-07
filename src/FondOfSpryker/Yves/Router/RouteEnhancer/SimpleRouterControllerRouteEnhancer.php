<?php

namespace FondOfSpryker\Yves\Router\RouteEnhancer;

use FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface;
use FondOfSpryker\Yves\Router\Exception\DefaultResourceCreatorNotSetException;
use Spryker\Yves\Kernel\BundleControllerAction;
use Spryker\Yves\Kernel\ClassResolver\Controller\ControllerResolver;
use Spryker\Yves\Kernel\Controller\BundleControllerActionRouteNameResolver;
use Symfony\Cmf\Component\Routing\Enhancer\RouteEnhancerInterface;
use Symfony\Component\HttpFoundation\Request;

class SimpleRouterControllerRouteEnhancer implements RouteEnhancerInterface
{
    /**
     * @var \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface[]
     */
    protected $resourceCreatorPlugins;

    /**
     * @param  \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface[]  $resourceCreatorPlugins
     */
    public function __construct(array $resourceCreatorPlugins)
    {
        $this->resourceCreatorPlugins = $resourceCreatorPlugins;
    }

    /**
     * @param  array  $defaults
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return array
     * @throws \FondOfSpryker\Yves\Router\Exception\DefaultResourceCreatorNotSetException
     * @throws \Spryker\Shared\Kernel\ClassResolver\Controller\ControllerNotFoundException
     */
    public function enhance(array $defaults, Request $request): array
    {
        foreach ($this->resourceCreatorPlugins as $resourceCreator) {
            if ($resourceCreator->isDefault() === false && $defaults['type'] === $resourceCreator->getType()) {
                $resourceCreator->modifyRequest($request);
                return $this->createResource($resourceCreator, $defaults);
            }
        }

        return $this->createResource($this->getDefaultResourceCreator(), $defaults);
    }

    /**
     * @param  \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface  $resourceCreator
     * @param  array  $data
     *
     * @return array
     *
     * @throws \Spryker\Shared\Kernel\ClassResolver\Controller\ControllerNotFoundException
     */
    protected function createResource(ResourceCreatorPluginInterface $resourceCreator, array $data)
    {
        $bundleControllerAction = new BundleControllerAction($resourceCreator->getModuleName(),
            $resourceCreator->getControllerName(), $resourceCreator->getActionName());
        $routeResolver = new BundleControllerActionRouteNameResolver($bundleControllerAction);

        $controllerResolver = new ControllerResolver();
        $controller = $controllerResolver->resolve($bundleControllerAction);
        $actionName = $resourceCreator->getActionName();
        if (strrpos($actionName, 'Action') === false) {
            $actionName .= 'Action';
        }

        $resourceCreatorResult['meta'] = $data;
        $resourceCreatorResult['_controller'] = [$controller, $actionName];
        $resourceCreatorResult['_route'] = $routeResolver->resolve();

        return $resourceCreatorResult;
    }

    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface
     * @throws \FondOfSpryker\Yves\Router\Exception\DefaultResourceCreatorNotSetException
     */
    protected function getDefaultResourceCreator(): ResourceCreatorPluginInterface
    {
        foreach ($this->resourceCreatorPlugins as $resourceCreatorPlugin){
            if ($resourceCreatorPlugin->isDefault()){
                return $resourceCreatorPlugin;
            }
        }

        throw new DefaultResourceCreatorNotSetException('Please set "isDefault = true" for one of the registered ResourceCreators in RouterDependencyProvider');
    }
}
