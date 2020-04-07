<?php

namespace FondOfSpryker\Yves\Router\RequestMatcher;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;

class SimpleRouterRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var array|\FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface[]
     */
    protected $requestMatcherPlugins;

    /**
     * SimpleRouterRequestMatcher constructor.
     *
     * @param  \FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface[]  $requestMatcherPlugins
     */
    public function __construct(
        array $requestMatcherPlugins
    ) {
        $this->requestMatcherPlugins = $requestMatcherPlugins;
    }

    /**
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return array
     * @throws \Exception
     */
    public function matchRequest(Request $request): array
    {
        foreach ($this->requestMatcherPlugins as $requestMatcherPlugin) {
            $data = $requestMatcherPlugin->handle($request);
            if ($data !== []) {
                return $data;
            }
        }

        throw new ResourceNotFoundException();
    }
}
