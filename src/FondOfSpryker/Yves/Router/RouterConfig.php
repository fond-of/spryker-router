<?php

namespace FondOfSpryker\Yves\Router;

use FondOfSpryker\Shared\Router\RouterConstants;
use Spryker\Yves\Router\RouterConfig as SprykerRouterConfig;

class RouterConfig extends SprykerRouterConfig
{
    /**
     * @return array
     */
    public function getExcludedRoutePrefixes(): array
    {
        return $this->get(RouterConstants::YVES_EXCLUDED_ROUTE_PREFIXES, ['/payone' => ['GET'], '/feed' => ['GET'], '/_profiler' => ['GET'], '/form' => ['GET']]);
    }
}
