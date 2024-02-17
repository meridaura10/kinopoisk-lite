<?php

namespace App\Kernel\Storage;

use App\Kernel\Config\Contracts\ConfigInterface;

class Storage implements Contracts\StorageInterface
{
    public function __construct(
        private ConfigInterface $config,
    ) {
    }

    public function url(string $path): string
    {
        $host = $this->config->get('app.host');

        return "$host/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents($this->storagePath($path));
    }

    private function storagePath(string $path)
    {
        return APP_PATH."/storage/$path";
    }
}
