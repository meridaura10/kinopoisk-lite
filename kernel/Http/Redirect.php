<?php

namespace App\Kernel\Http;
use App\Kernel\Http\Contracts\RedirectInterface;

class Redirect implements RedirectInterface
{
    public function to(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
