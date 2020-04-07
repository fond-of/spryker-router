<?php

namespace FondOfSpryker\Shared\Router;

use Spryker\Shared\Router\RouterConstants as SprykerRouterConstantsAlias;

interface RouterConstants extends SprykerRouterConstantsAlias
{
    /**
     * Specification:
     * - An array of excluded route prefixes
     * - Example: `['/payone' => ['GET'], '/feed' => ['GET'], '/_profiler' => ['GET'], '/form' => ['GET']]`
     *
     * @api
     */
    public const YVES_EXCLUDED_ROUTE_PREFIXES = 'ROUTER:YVES_EXCLUDED_ROUTE_PREFIXES';

    public const REDIRECT_TYPE = 'redirect';

    public const INTERNAL_REDIRECT_TYPE = 'internalRedirect';

    public const RESOURCE_NOT_FOUND_TYPE = 'resourceNotFound';
}
