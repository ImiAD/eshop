<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\Contracts\Service;
use App\Helpers\PasswordHash;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService implements Service
{
    private CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createCustomer(array $data): ?Customer
    {
        $params = array_merge($data, [
            'password' => PasswordHash::make($data['password']),
            'is_ban' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $lastId = $this->repository->createCustomer($params);

        return $lastId ? Customer::writeNewForm(array_merge($params, ['id' => $lastId])) : null;
    }

    public function findByIdCustomer(array $data): ?Customer
    {
        $result = $this->repository->findByIdCustomer($data);

        if (empty($result)) {
            return null;
        }

        if (!PasswordHash::verify($data['password'], $result['password'])) {
            return null;
        }

        return $result ? Customer::writeNewForm($result) : null;
    }
}
