<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Contracts\Database;
use App\Models\Customer;

class CustomerRepository
{
    private Database $queryBuilder;
    private string $tableName;

    public function __construct(Database $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->tableName = Customer::getTableName();
    }

    public function createCustomer(array $data): ?int
    {
        $sth = $this->queryBuilder->prepare(
    "INSERT INTO {$this->tableName}
            (first_name, last_name, email, password, is_ban, created_at, updated_at)
          VALUES
            (:first_name, :last_name, :email, :password, :is_ban, :created_at, :updated_at)"
        );

        $sth->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':is_ban' => $data['is_ban'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
        ]);

        return $sth->rowCount() ? $this->queryBuilder->lastInsertId() : null;
    }

    public function findByIdCustomer(array $data): array
    {
        $sth = $this->queryBuilder->prepare(
            "SELECT id, first_name, last_name, email, password, is_ban, created_at, updated_at
                FROM {$this->tableName} WHERE email = :email LIMIT 1"
        );
        $sth->execute([
            ':email' => $data['email'],
        ]);

        return $sth->fetch();
    }
}
