<?php
declare(strict_types=1);

namespace App\Core\Contracts;

interface Database
{
    public function exec($query): int;
    public function prepare(string $query): Database;
    public function execute(array $params = []): Database;
    public function fetch(): array;
    public function fetchAll(): array;
    public function lastInsertId(): int;
    public function rowCount(): int;
}
