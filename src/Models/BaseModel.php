<?php
declare(strict_types=1);

namespace App\Models;

abstract class BaseModel
{
    public static function writeNewForm(array $data): static
    {
        $item = new static($data);

        if (!empty($data['id'])) {
            $item->id = (int)$data['id'];
        }

        return $item;
    }
}
