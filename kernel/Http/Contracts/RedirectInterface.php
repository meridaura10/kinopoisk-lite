<?php


namespace App\Kernel\Http\Contracts;

interface RedirectInterface
{
    public function to(string $url): void;
}
