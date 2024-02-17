<?php

namespace App\Kernel\Upload;

use App\Kernel\Upload\Contracts\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size = 0,
    ) {

    }

    public function move(string $path, ?string $name = null): string|false
    {
        $storagePath = APP_PATH."/storage/$path";

        if (! is_dir($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $fileName = $name ?? $this->generateFileName();

        $filePath = "$storagePath/$fileName";

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return "$path/$fileName";
        }

        return false;
    }

    public function empty(): bool
    {
        return ! $this->size;
    }

    private function generateFileName(): string
    {
        return md5(uniqid(rand(), true)).".{$this->getExtension()}";
    }

    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }
}
