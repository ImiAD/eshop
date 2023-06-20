<?php

namespace App\Services;

use App\Core\Contracts\Service;
use App\Helpers\PasswordHash;
use App\Models\Manager;
use App\Repositories\ManagerRepository;

class ManagerService implements Service
{
    private ManagerRepository $repository;

    public function __construct(ManagerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createManager(array $data): ?Manager
    {
        $params = array_merge($data, [
            'password' => PasswordHash::make($data['password']),
            'is_ban' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $lastId = $this->repository->createManager($params);

        return $lastId ? Manager::writeNewForm(array_merge($params, ['id' => $lastId])) : null;
    }

    public function findByIdManager(array $data): ?Manager
    {
        $result = $this->repository->findByIdManager($data);

        if (empty($result)) {
            return null;
        }

        if (!PasswordHash::verify($data['password'], $result['password'])) {
            return null;
        }

        return $result ? Manager::writeNewForm($result) : null;
    }
}