<?php


namespace App\Kernel\Router\Contracts;


interface RouterInterface
{
    public function dispath(string $uri, string $method): void;
}
