<?php
declare(strict_types=1);

namespace App\Core\Http;

class Response
{
    public function setStatusCode(int $code = 200): void
    {
        http_response_code($code);
    }
}
