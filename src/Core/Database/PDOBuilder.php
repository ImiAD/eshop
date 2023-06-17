<?php
declare(strict_types=1);

namespace App\Core\Database;

use App\Core\Contracts\Database;

class PDOBuilder implements Database
{
    private static ?PDOBuilder $instance = null;
    private ?\PDO $dbh;
    private ?\PDOStatement $sth;

    public static function getInstance(): PDOBuilder
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        try {
            $this->dbh = new \PDO(
                'mysql:host=localhost;dbname=db-eshop;charset=utf8mb4',
                'root',
                '', [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                ],
            );
        } catch (\PDOException $e) {
            throw new \PDOException( 'Ошибка сервера: 500' . $e->getMessage(), 500);
        }
    }

    public function exec($query): int
    {
        return (int)$this->dbh->exec($query);
    }

    public function prepare(string $query): Database
    {
        $this->sth = $this->dbh->prepare($query);

        return $this;
    }

    public function execute(array $params = []): Database
    {
        $this->sth->execute($params);

        return $this;
    }

    public function fetch(): array
    {
        $result = $this->sth->fetch();
        $this->sth = null;

        return $result !== false ? $result : [];
    }

    public function fetchAll(): array
    {
        $result = $this->sth->fetchAll();
        $this->sth = null;

        return $result;
    }

    public function lastInsertId(): int
    {
        return (int)$this->dbh->lastInsertId();
    }

    public function rowCount(): int
    {
        return $this->sth->rowCount();
    }
}
