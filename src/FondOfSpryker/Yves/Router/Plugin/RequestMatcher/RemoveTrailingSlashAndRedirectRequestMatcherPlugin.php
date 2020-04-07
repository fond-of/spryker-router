<?php

namespace FondOfSpryker\Yves\Router\Plugin\RequestMatcher;

use FondOfSpryker\Shared\Router\RouterConstants;
use FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CrawlerRequestMatcherPlugin
 * @method \FondOfSpryker\Yves\Router\RouterFactory getFactory()
 * @method \FondOfSpryker\Yves\Router\RouterConfig getConfig()
 */
class RemoveTrailingSlashAndRedirectRequestMatcherPlugin extends AbstractPlugin implements RequestMatcherPluginInterface
{
    /**
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return array
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function handle(Request $request): array
    {
        if ($this->hasTrailingSlash($request->getPathInfo())) {
            return $this->redirectWithoutTrailingSlash($request);
        }

        return [];
    }

    /**
     * @param string $pathinfo
     *
     * @return bool
     */
    protected function hasTrailingSlash(string $pathinfo): bool
    {
        return substr($pathinfo, -1) == '/';
    }

    /**
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return array
     */
    protected function redirectWithoutTrailingSlash(Request $request): array
    {
        $uri = substr($request->getSchemeAndHttpHost() . $request->getPathInfo(), 0, -1);
        $uri = $this->appendQueryStringToUri($uri, $request);

        return $this->createRedirect($uri);
    }

    /**
     * @param  string  $uri
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return string
     */
    protected function appendQueryStringToUri(string $uri, Request $request): string
    {
        $queryString = $request->getQueryString();
        if (is_string($queryString) && strlen($queryString) > 0) {
            return $uri . '?' . $queryString;
        }

        return $uri;
    }

    /**
     * @param string $toUri
     * @param int $statusCode
     *
     * @return string[]
     */
    protected function createRedirect(string $toUri, int $statusCode = 301): array
    {
        return ['to_url' => $toUri, 'status' => $statusCode, 'type' => RouterConstants::REDIRECT_TYPE];
    }

}
