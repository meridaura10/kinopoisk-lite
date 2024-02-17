<?php

namespace App\Kernel\Session;

use App\Kernel\Session\Contracts\SessionInterface;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getFlash(string $key, mixed $default = null): mixed
    {
        $value  = $this->get($key, $default);
        $this->remove($key);

        return $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}
