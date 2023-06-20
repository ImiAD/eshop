<?php
declare(strict_types=1);

namespace App\Core;

final class Config
{
    private static ?Config $instance = null;
    private array $messageData = [];
    private array $routes = [];
    private array $const = [];

    public static function getInstance(): Config
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->init();
    }

    private function init(): void
    {
        $this->messageData = require __DIR__ . '/../../config/messages.php';
        $this->routes = require __DIR__ . '/../../config/routes.php';
        $this->const = require __DIR__ . '/../../config/const.php';
    }

    public function messages(?string $key = null): array|string
    {
        return is_null($key) ? $this->messageData : $this->messageData[$key];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getError(string $key): string
    {
        return $this->messageData['form.messages']['errors'][$key];
    }

    public function getConst(): array
    {
        return $this->const;
    }
}
