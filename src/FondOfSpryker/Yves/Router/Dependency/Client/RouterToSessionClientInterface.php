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

    /**
     * @param  string  $name
     * @param  mixed  $value
     *
     * @return void
     */
    public function set(string $name, $value): void;
}
