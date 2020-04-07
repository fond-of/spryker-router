<?php

namespace FondOfSpryker\Yves\Router\Plugin\RouterEnhancer;

use FondOfSpryker\Shared\Router\RouterConstants;
use FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ResourceNotFoundResourceCreatorPlugin implements ResourceCreatorPluginInterface
{
    protected const TEMPLATE_VAR = '_template';

    protected const TEMPLATE_TO_USE = 'ErrorPage/error404/index';

    /**
     * @var bool
     */
    protected $isDefault;

    /**
     * RedirectInternalResourceCreatorPlugin constructor.
     *
     * @param  bool  $isDefault
     */
    public function __construct(bool $isDefault = false)
    {
        $this->isDefault = $isDefault;
    }

    public function getType(): string
    {
        return RouterConstants::RESOURCE_NOT_FOUND_TYPE;
    }

    public function getModuleName(): string
    {
        return 'ErrorPage';
    }

    public function getActionName(): string
    {
        return 'index';
    }

    public function getControllerName(): string
    {
        return 'Error404';
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return void
     */
    public function modifyRequest(Request $request): void
    {
        $this->setErrorTemplate($request);
    }

    /**
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     */
    protected function setErrorTemplate(Request $request): void
    {
        $attributes = $request->attributes;
        if (!($attributes instanceof ParameterBag)) {
            $attributes = new ParameterBag();
        }

        $attributes->set(static::TEMPLATE_VAR, static::TEMPLATE_TO_USE);
        $request->attributes = $attributes;
    }
}
