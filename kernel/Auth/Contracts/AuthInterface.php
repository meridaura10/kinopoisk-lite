<?php

namespace App\Kernel\Auth\Contracts;

use App\Kernel\Auth\User;

interface AuthInterface
{
    public function attempt(string $email, string $password): bool;

    public function register(string $name, string $email, string $password): bool;

    public function loqout(): void;

    public function check(): bool;

    public function user(): ?User;

    public function uniqSearchField(): string;

    public function table(): string;

    public function passwordField(): string;

    public function sessionField(): string;
}
