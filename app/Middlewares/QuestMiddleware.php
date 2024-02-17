<?php

namespace App\Middlewares;

use App\Kernel\Middleware\Middleware;

class QuestMiddleware extends Middleware
{
    public function handle(): void
    {
        if ($this->auth->check()) {
            $this->redirect->to('/');
        }
    }
}
