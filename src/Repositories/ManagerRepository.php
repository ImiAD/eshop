<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Contracts\Database;
use App\Models\Manager;

class ManagerRepository
{
    private Database $queryBuilder;
    private string $tableName;

    public function __construct(Database $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->tableName = Manager::getTableName();
    }

    public function createManager(array $data): ?int
    {
        $sth = $this->queryBuilder->prepare(
            "INSERT INTO {$this->tableName}
                        (user_name, email, password, is_ban, created_at, updated_at)
                    VALUES
                        (:user_name, :email, :password, :is_ban, :created_at, :updated_at)"
        );

        $sth->execute([
            ':user_name' => $data['user_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':is_ban' => $data['is_ban'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
        ]);

        return $sth->rowCount() ? $this->queryBuilder->lastInsertId() : null;
    }

    public function findByIdManager(array $data): array
    {
        $sth = $this->queryBuilder->prepare(
            "SELECT id, user_name, email, password, is_ban, created_at, updated_at
                FROM {$this->tableName} WHERE email = :email LIMIT 1"
        );

        $sth->execute([
            ':email' => $data['email'],
        ]);

        return $sth->fetch();
    }
}
