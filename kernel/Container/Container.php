<?php

namespace App\Kernel\Container;

use App\Kernel\Auth\Auth;
use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Config\Config;
use App\Kernel\Config\Contracts\ConfigInterface;
use App\Kernel\Database\Contracts\DatabaseInterface;
use App\Kernel\Database\Database;
use App\Kernel\Http\Contracts\RedirectInterface;
use App\Kernel\Http\Contracts\RequestInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Router\Contracts\RouterInterface;
use App\Kernel\Router\Router;
use App\Kernel\Session\Contracts\SessionInterface;
use App\Kernel\Session\Session;
use App\Kernel\Storage\Contracts\StorageInterface;
use App\Kernel\Storage\Storage;
use App\Kernel\Validator\Contracts\ValidatorInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\View\Contracts\ViewInterface;
use App\Kernel\View\View;

class Container
{
    public readonly RequestInterface $request;

    public readonly RouterInterface $router;

    public readonly ViewInterface $view;

    public readonly ValidatorInterface $validator;

    public readonly RedirectInterface $redirect;

    public readonly SessionInterface $session;

    public readonly ConfigInterface $config;

    public readonly DatabaseInterface $database;

    public readonly AuthInterface $auth;

    public readonly StorageInterface $storage;

    public function __construct()
    {
        $this->register();
    }

    private function register()
    {
        $this->session = new Session;
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->auth = new Auth($this->database, $this->session, $this->config);
        $this->storage = new Storage($this->config);
        $this->view = new View($this->session, $this->auth, $this->storage);
        $this->validator = new Validator;
        $this->redirect = new Redirect;
        $this->request = Request::create()->setValidator($this->validator);

        $this->router = new Router(
            $this->view,
            $this->request,
            $this->redirect,
            $this->session,
            $this->database,
            $this->auth,
            $this->storage,
        );
    }
}
