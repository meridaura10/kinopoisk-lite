<?php

namespace App\Controllers\Auth;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('auth/login');
    }

    public function login(): void
    {
        $validation = $this->request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/auth/login');

            return;
        }

        if ($this->auth()->attempt(
            $this->request()->input('email'),
            $this->request()->input('password'),
        )) {
            $this->redirect('/');

            return;
        }

        $this->session()->set('error', 'Невірний логін або пароль');

        $this->redirect('/auth/login');
    }
}
