<?php

namespace FondOfSpryker\Yves\Router\Plugin\RouterEnhancer;

use FondOfSpryker\Shared\Router\RouterConstants;
use FondOfSpryker\Yves\Router\Dependency\Plugin\ResourceCreatorPluginInterface;
use Symfony\Component\HttpFoundation\Request;

class RedirectResourceCreatorPlugin implements ResourceCreatorPluginInterface
{
    /**
     * @var bool
     */
    protected $isDefault;

    /**
     * @param bool $isDefault
     */
    public function __construct(bool $isDefault = false)
    {
        $this->isDefault = $isDefault;
    }

    public function getType(): string
    {
        return RouterConstants::REDIRECT_TYPE;
    }

    public function getModuleName(): string
    {
        return 'Redirect';
    }

    public function getActionName(): string
    {
        return 'redirect';
    }

    public function getControllerName(): string
    {
        return 'Redirect';
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function modifyRequest(Request $request): void
    {
    }
}
