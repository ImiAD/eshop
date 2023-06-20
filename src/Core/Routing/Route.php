<?php
declare(strict_types=1);

namespace App\Core\Routing;

use App\Core\Config;
use App\Core\Contracts\Service;
use App\Core\Http\HttpStatusCode;
use App\Core\Http\Request;
use App\Factory\ServicesFactory;

class Route
{
    private string $controller = '';
    private Config $config;
    private Service $service;

    public function __construct(Config $config)
    {
        $this->config = $config;
//        $this->service = ServicesFactory::create($config->getConst()['MANAGER_SERVICE']);
        $this->service = ServicesFactory::create($config->getConst()['CUSTOMER_SERVICE']);
    }

//    public function run(Config $config): string
    public function run(): string
    {
        $partsUrl = $this->parseUrl();

        if (!$this->matchRoute($partsUrl['path'] ?? '', $this->config->getRoutes())) {
            throw new \RuntimeException("Контроллер не найден: {$partsUrl['path']}", HttpStatusCode::NOT_FOUND);
        }

        $parts = explode('@', $this->controller);

        if (!class_exists($parts[0])) {
            throw new \RuntimeException("Класс не найден: {$partsUrl['path']}", HttpStatusCode::NOT_FOUND);
        }

//        $controller = new $parts[0](new Request(), $config);
//        $controller = new $parts[0](new Request(), $this->config);
        // Скорее всего лучше использовать Enum класс с константами, чтобы конструктор каждого контроллера не пробрасывать
        // сервис, который может быть не везде нужен.
        // С классом Enum хотел сделать первоначально и сделать это было бы на много проще.
        $controller = new $parts[0](new Request(), $this->config, $this->service);

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
