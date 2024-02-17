<?php

namespace App\Kernel\Http\Contracts;

use App\Kernel\Upload\Contracts\UploadedFileInterface;
use App\Kernel\Validator\Contracts\ValidatorInterface;

interface RequestInterface
{
    public function uri(): string;

    public function method(): string;

    public static function create(): static;

    public function input(string $key, $default = null): mixed;

    public function file(string $key): ?UploadedFileInterface;

    public function setValidator(ValidatorInterface $validator): static;

    public function validate(array $rules): bool;

    public function errors(): array;
}
