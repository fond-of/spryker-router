<?php

namespace FondOfSpryker\Yves\Router\Dependency\Client;

interface RouterToSessionClientInterface
{
    /**
     * @param  string  $name
     * @param  null  $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null);
}
