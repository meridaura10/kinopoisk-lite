<?php

namespace App\Kernel\Middleware;

use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Http\Contracts\RedirectInterface;
use App\Kernel\Http\Contracts\RequestInterface;

abstract class Middleware
{
    public function __construct(
        protected RequestInterface $request,
        protected AuthInterface $auth,
        protected RedirectInterface $redirect,
    ) {
    }

    abstract public function handle(): void;
}
