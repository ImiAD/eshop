<?php
declare(strict_types=1);

namespace App\Models;

class Customer  extends BaseModel
{
    protected int $id = 0;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $password;
    protected int $isBan;
    protected string $createdAt;
    protected string $updatedAt;

    public function __construct(array $data)
    {
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->isBan = (int)$data['is_ban'];
        $this->createdAt = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updatedAt = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
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
