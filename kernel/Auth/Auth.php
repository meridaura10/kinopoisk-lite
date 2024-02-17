<?php

namespace App\Kernel\Auth;

use App\Kernel\Auth\Contracts\AuthInterface;
use App\Kernel\Config\Contracts\ConfigInterface;
use App\Kernel\Database\Contracts\DatabaseInterface;
use App\Kernel\Session\Contracts\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $database,
        private SessionInterface $session,
        private ConfigInterface $config,
    ) {

    }

    public function attempt(string $email, string $password): bool
    {
        $user = $this->database->first($this->table(), [
            $this->uniqSearchField() => $email,
        ]);

        if (! $user) {
            return false;
        }

        if (! password_verify($password, $user[$this->passwordField()])) {
            return false;
        }

        $this->session->set($this->sessionField(), $user['id']);

        return true;
    }

    public function loqout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function user(): ?User
    {
        if (! $this->check()) {
            return null;
        }

        $user = $this->database->first($this->table(), [
            'id' => $this->session->get($this->sessionField()),
        ]);

        if (! $user) {
            return null;
        }

        return new User($user['id'], $user['email']);
    }

    public function uniqSearchField(): string
    {
        return $this->config->get('auth.uniqSearchField');
    }

    public function table(): string
    {
        return $this->config->get('auth.table');
    }

    public function passwordField(): string
    {
        return $this->config->get('auth.passwordField');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.sessionField');
    }

    public function register(string $name, string $email, string $password): bool
    {
        try {
            $id = $this->database->insert($this->table(), [
                'name' => $name,
                $this->uniqSearchField() => $email,
                $this->passwordField() => password_hash($password, PASSWORD_DEFAULT),
            ]);

            $this->session->set($this->sessionField(), $id);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
