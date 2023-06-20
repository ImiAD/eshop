<?php
declare(strict_types=1);

namespace App\Factory;

use App\Core\Contracts\Service;
use App\Core\Database\PDOBuilder;
use App\Repositories\CustomerRepository;
use App\Repositories\ManagerRepository;
use App\Services\CustomerService;
use App\Services\ManagerService;

final class ServicesFactory
{
    public static function create(string $type): Service
    {
        return match($type) {
            'CUSTOMER' => new CustomerService(new CustomerRepository(PDOBuilder::getInstance())),
            'MANAGER' => new ManagerService(new ManagerRepository(PDOBuilder::getInstance())),
            default => throw new \RuntimeException('Некорректный сервис.'),
        };
    }
}
