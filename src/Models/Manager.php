<?php
declare(strict_types=1);

namespace App\Models;

class Manager extends BaseModel
{
    protected int $id = 0;
    protected string $userName;
    protected string $email;
    protected string $password;
    protected int $isBan;
    protected string $createdAt;
    protected string $updatedAt;

    // Непонятно за что будет в дальнейшем отвечать базовая модель. Если от нее будут наследоваться только пользователи,
    // то в нее нужно вынести схожие для всех пользователей свойства и в конструктор поместить их инициализацию.
    // Если от модели baseModel будут наследоваться еще-кикие-то сущности, этого делать нельзя.
    public function __construct(array $data)
    {
        $this->userName = $data['user_name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->isBan = (int)$data['is_ban'];
        $this->createdAt = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updatedAt = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public static function getTableName(): string
    {
        return 'manager';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsBan(): int
    {
        return $this->isBan;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
