# spryker-router

Provides new simple router with plugins
* redirect crawler to 404 pages
* disable some routes like /de/payone for GET method (depends on configuration)
* remove trailing slash from url
* validates language prefix

Provides some event modifier plugins
* RouterLanguageRedirectEventDispatcherPlugin => is no language selected by url, redirect the user to language in session or browser detected language

## Install
```
composer require fond-of-spryker/router
```

##### Point used classes in src/Pyz/Yves/Router to vendor/fond-of-spryker/router/src/FondOfSpryker/Yves/Router for example
```
use FondOfSpryker\Yves\Router\RouterDependencyProvider as FondOfSprykerRouterDependencyProvider;

class RouterDependencyProvider extends FondOfSprykerRouterDependencyProvider
```

##### Register SimpleRouterPlugin to RouterDependencyProvider

```
    /**
     * @return \Spryker\Yves\RouterExtension\Dependency\Plugin\RouterPluginInterface[]
     */
    protected function getRouterPlugins(): array
    {
        return [
            new SimpleRouterPlugin(),
            ...
        ];
    }
```

#### Register in EventDispatcherDependencyProvider

```
/**
 * @return \Spryker\Shared\EventDispatcherExtension\Dependency\Plugin\EventDispatcherPluginInterface[]
 */
 protected function getEventDispatcherPlugins(): array
 {
    return [
            ...
            new RouterLanguageRedirectEventDispatcherPlugin(),
        ];
    }
```

#### Register RequestMatcher plugins to RouterDependencyProvider

```
    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\RequestMatcherPluginInterface[]
     */
    protected function getRequestMatcherPluginsSimpleRouter(): array
    {
        return [
            new CrawlerRequestMatcherPlugin(),
            new DisableRoutesRequestMatcherPlugin(),
            new ValidateLocalePrefixRequestMatcherPlugin(),
            new RemoveTrailingSlashAndRedirectRequestMatcherPlugin(),
        ];
    }
```

#### Register RouterEnhancer plugins to RouterDependencyProvider
```
    /**
     * @return \FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreator\ResourceCreatorPluginInterface[]
     */
    protected function getSimpleRouterResourceCreatorPlugins()
    {
        return [
            new RedirectInternalResourceCreatorPlugin(),
            new RedirectResourceCreatorPlugin(true),
            new ResourceNotFoundResourceCreatorPlugin(),
        ];
    }
```

## Configuration

Default 404 redirect routes for DisableRoutesRequestMatcherPlugins are
* ['/payone' => ['GET'], '/feed' => ['GET'], '/_profiler' => ['GET'], '/form' => ['GET']]
If others are needed, just override it in config/Shared/config_default.php or other.
```
$config[RouterConstants::YVES_EXCLUDED_ROUTE_PREFIXES] = ['/feed' => ['GET', 'POST']];
```
