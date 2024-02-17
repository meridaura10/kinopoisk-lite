<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Database\Contracts\DatabaseInterface;
use App\Kernel\Http\Contracts\RedirectInterface;
use App\Kernel\Http\Contracts\RequestInterface;
use App\Kernel\Session\Contracts\SessionInterface;
use App\Kernel\Storage\Contracts\StorageInterface;
use App\Kernel\View\Contracts\ViewInterface;
use App\Kernel\View\View;

abstract class Controller
{
    private ViewInterface $view;

    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    private DatabaseInterface $database;

    private AuthInterface $auth;

    private StorageInterface $storage;

    public function view(string $name, array $data = [])
    {
        $this->view->page($name, $data);
    }

    public function setDatabase(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function database(): DatabaseInterface
    {
        return $this->database;
    }

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function redirect(string $url)
    {
        $this->redirect->to($url);
    }

    public function setRedirect(RedirectInterface $redirect)
    {
        $this->redirect = $redirect;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session)
    {
        return $this->session = $session;
    }

    public function auth(): AuthInterface
    {
        return $this->auth;
    }

    public function setAuth(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function storage(): StorageInterface
    {
        return $this->storage;
    }
}
