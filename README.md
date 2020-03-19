# spryker-router

Provides some plugins
* RouterLanguageRedirectEventDispatcherPlugin => is no language selected by url, redirect the user to language in session or browser detected language

## Install
```
composer require fond-of-spryker/router
```

Point used classes in src/Pyz/Yves/Router to vendor/fond-of-spryker/router/src/FondOfSpryker/Yves/Router for example
```
use FondOfSpryker\Yves\Router\RouterDependencyProvider as FondOfSprykerRouterDependencyProvider;

class RouterDependencyProvider extends FondOfSprykerRouterDependencyProvider
```

## Configuration

#### RouterLanguageRedirectEventDispatcherPlugin
Register in EventDispatcherDependencyProvider

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
