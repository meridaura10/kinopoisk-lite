<?php

namespace App\Controllers\Auth;

use App\Kernel\Controller\Controller;

class logoutController extends Controller
{
    public function logout(): void
    {
        $this->auth()->loqout();

        $this->redirect('/auth/login');
    }
}
