<?php
declare(strict_types=1);

namespace App\Helpers;

class PasswordHash
{
    public static function make(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verify(string $data, string $password): bool
    {
        return password_verify($data, $password);
    }
}
