<?php
declare(strict_types=1);

namespace App\Core\Routing;

use App\Core\Config;
use App\Core\Http\HttpStatusCode;
use App\Core\Http\Request;

class Route
{
    private string $controller = '';

    public function run(Config $config): string
    {
        $partsUrl = $this->parseUrl();

        if (!$this->matchRoute($partsUrl['path'] ?? '', $config->getRoutes())) {
            throw new \RuntimeException("Контроллер не найден: {$partsUrl['path']}", HttpStatusCode::NOT_FOUND);
        }

        $parts = explode('@', $this->controller);

        if (!class_exists($parts[0])) {
            throw new \RuntimeException("Класс не найден: {$partsUrl['path']}", HttpStatusCode::NOT_FOUND);
        }

        $controller = new $parts[0](new Request());

        return $controller->{$parts[1]}();
    }

    private function parseUrl(): array
    {
        return \parse_url(\trim($_SERVER['REQUEST_URI'], '/'));
    }

    private function matchRoute(string $url, array $routes): bool
    {
        foreach ($routes as $route) {
            if (preg_match($route['url'], $url)) {
                $this->controller = $route['controller'];

                return true;
            }
        }

        return false;
    }
}
