<?php
declare(strict_types=1);

namespace App\Core\Http;

class Request
{
    private function requestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function method(?string $method = null): string|bool
    {
        if (!empty($method)) {
            return \strtoupper($this->requestMethod()) === \strtoupper($method);
        }

        return $this->requestMethod();
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function isGet(): bool
    {
        return \strtoupper($this->requestMethod()) === 'GET';
    }

    public function isPost(): bool
    {
        return \strtoupper($this->requestMethod()) === 'POST';
    }

    public function get(?string $key = null): array|string
    {
        return is_null($key) ? $_GET : $_GET[$key];
    }

    public function post(?string $key = null): array|string
    {
        return is_null($key) ? $_POST : $_POST[$key];
    }

    public function files(?string $key = null): array|string
    {
        return is_null($key) ? $_FILES : $_FILES[$key];
    }

    public function hasFile(?string $key = null): array
    {
        return is_null($key) ? $_FILES : $_FILES[$key];
    }
}
