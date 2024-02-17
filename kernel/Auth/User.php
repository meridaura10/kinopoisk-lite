<?php

namespace App\Kernel\Auth;

class User
{
    public function __construct(
        private int $id,
        private string $email,
        //        public readonly string $name,
    ) {

    }

    public function name(): string
    {
        //        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function id(): string
    {
        return $this->id;
    }
}
