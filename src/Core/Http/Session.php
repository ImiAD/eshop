<?php
declare(strict_types=1);

namespace App\Core\Http;

class Session
{
    public function getId(): string
    {
        return session_id();
    }

    public function start(bool $flag): void
    {
        if ($flag) {
            session_start();
        }
    }

    public function get(?string $key = null): array|string
    {
        return is_null($key) ? $_SESSION : $_SESSION[$key];
    }

    public function clear(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
            unset($_SESSION[$key]);
            session_destroy();

            return true;
        }

        return false;
    }

    public function destroy(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
            unset($_SESSION[$key]);
            session_unset();
            session_destroy();

            return true;
        }

        return false;
    }
}
