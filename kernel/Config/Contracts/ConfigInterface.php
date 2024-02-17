<?php

namespace App\Kernel\Config\Contracts;

interface ConfigInterface
{
    public function get(string $key, $default = null): mixed;
}
