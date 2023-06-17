<?php
declare(strict_types=1);

namespace App\Core\Contracts;

interface Validator
{
    public function load(array $data): Validator;
}
