<?php
declare(strict_types=1);

namespace App\Core;

final class Config
{
    private static ?Config $instance = null;
    private array $messageData = [];
    private array $routes = [];

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
    }

    public function messages(?string $key = null): array|string
    {
        return is_null($key) ? $this->messageData : $this->messageData[$key];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
