<?php

namespace FondOfSpryker\Yves\Router\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

interface RouterToStoreClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
