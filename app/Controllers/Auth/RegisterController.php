<?php

namespace App\Controllers\Auth;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('auth/register');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/auth/register');
        }

        $this->auth()->register(
            $this->request()->input('name'),
            $this->request()->input('email'),
            $this->request()->input('password'),
        );

        $this->redirect('/');
    }
}
