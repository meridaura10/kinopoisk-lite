<?php

namespace App\Kernel\Validator\Contracts;

interface ValidatorInterface
{
    public function errors(): array;

    public function validate(array $data, array $rules): bool;
}
