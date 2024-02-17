<?php

namespace App\Kernel\Upload\Contracts;

interface UploadedFileInterface
{
    public function move(string $path, ?string $name = null): string|false;

    public function empty(): bool;

    public function getExtension(): string;
}
