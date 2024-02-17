<?php

namespace App\Kernel\View;

use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Exception\ViewNotFoundException;
use App\Kernel\Session\Contracts\SessionInterface;
use App\Kernel\Storage\Contracts\StorageInterface;
use App\Kernel\View\Contracts\ViewInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {
    }

    public function page(string $name, array $data = []): void
    {
        $path = APP_PATH."/views/pages/$name.php";

        if (! file_exists($path)) {
            throw new ViewNotFoundException("view page $name not found");
        }

        extract([
            ...$this->defaultData(),
            ...$data,
        ]);

        include_once $path;
    }

    public function component(string $name, array $data = []): void
    {
        $path = APP_PATH."/views/components/$name.php";

        if (! file_exists($path)) {
            throw new ViewNotFoundException("view component $name not found");
        }

        extract([
            ...$this->defaultData(),
            ...$data,
        ]);

        include $path;
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'storage' => $this->storage,
        ];
    }
}
