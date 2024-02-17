<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Database\Contracts\DatabaseInterface;
use App\Kernel\Http\Contracts\RedirectInterface;
use App\Kernel\Http\Contracts\RequestInterface;
use App\Kernel\Router\Contracts\RouterInterface;
use App\Kernel\Session\Contracts\SessionInterface;
use App\Kernel\Storage\Contracts\StorageInterface;
use App\Kernel\View\Contracts\ViewInterface;

class Router implements RouterInterface
{
    private $routes = [];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DatabaseInterface $database,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {
        $this->initRoutes();
    }

    public function dispath(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->notFound();
        }

        if ($route->hasMiddlewares()) {
            foreach ($route->getMiddlewares() as $middleware) {
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }

        $action = $route->getAction();

        if (is_array($action)) {
            [$controller, $action] = $action;

            $controller = new $controller;
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setStorage'], $this->storage);
            call_user_func([$controller, $action]);
        }

        if (is_string($action) && class_exists($action)) {
            $object = new $action;
            $object->setView($this->view);
            $object->setRequest($this->request);
            $object->setRedirect($this->redirect);
            $object->setSession($this->session);
            $object->setDatabase($this->database);
            $object->setAuth($this->auth);
            $object->setStorage($this->storage);
            $object();
        }
    }

    private function notFound(): void
    {
        echo '404 | not found';
        exit;
    }

    private function findRoute(string $uri, string $method): ?Route
    {
        if (! isset($this->routes[$method][$uri])) {
            return null;
        }

        return $this->routes[$method][$uri];
    }

    public function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes()
    {
        return require_once APP_PATH.'/routes/web.php';
    }
}
