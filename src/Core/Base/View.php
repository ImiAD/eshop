<?php
declare(strict_types=1);

namespace App\Core\Base;

class View
{
    public function render(string $filePath, array $data = []): bool|string
    {
        $content = $this->extract($filePath, $data);

        ob_start();
        require __DIR__ . '/../../../views/shop/layouts/default.php';

        return ob_get_clean();
    }

    private function extract(string $filePath, array $data)
    {
        extract($data);

        ob_start();
        require __DIR__ . "/../../../views/{$filePath}.php";

        return ob_get_clean();
    }

    private function getPath(string $value): string
    {
        return str_replace('.', '/', $value);
    }
}
