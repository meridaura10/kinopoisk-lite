<?php

namespace App\Kernel\Router;

class Route
{
    public function __construct(
        private string $url,
        private string $method,
        private $action,
        private array $middlewares = [],
    ) {
    }

    public static function get(string $uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public function setMiddlewares($middlewares = []): static
    {
        $this->middlewares = $middlewares;

        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function hasMiddlewares(): bool
    {
        return count($this->middlewares);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function getUri(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }
}
