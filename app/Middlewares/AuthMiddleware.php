<?php

namespace App\Middlewares;

use App\Kernel\Middleware\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle(): void
    {
        if (! $this->auth->check()) {
            $this->redirect->to('/auth/login');
        }
    }
}
