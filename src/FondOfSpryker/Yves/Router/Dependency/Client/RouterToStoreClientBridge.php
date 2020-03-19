<?php

namespace FondOfSpryker\Yves\Router\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Client\Store\StoreClientInterface;

class RouterToStoreClientBridge implements RouterToStoreClientInterface
{
    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    protected $storeClient;

    /**
     * RouterToStoreClientBridge constructor.
     *
     * @param  \Spryker\Client\Store\StoreClientInterface  $storeClient
     */
    public function __construct(StoreClientInterface $storeClient)
    {
        $this->storeClient = $storeClient;
    }

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer
    {
        return $this->storeClient->getCurrentStore();
    }
}
