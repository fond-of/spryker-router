<?php

namespace FondOfSpryker\Yves\Router\Dependency\Client;

use Spryker\Client\Session\SessionClientInterface;

class RouterToSessionClientBridge implements RouterToSessionClientInterface
{
    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClient;

    /**
     * RouterToSessionClientBridge constructor.
     *
     * @param  \Spryker\Client\Session\SessionClientInterface  $sessionClient
     */
    public function __construct(SessionClientInterface $sessionClient)
    {
        $this->sessionClient = $sessionClient;
    }

    /**
     * @param  string  $name
     * @param  null  $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return $this->sessionClient->get($name, $default);
    }
}
