<?php
declare(strict_types=1);

namespace App\Core\Http;

class HttpStatusCode
{
    public const OK = 200;
    public const CREATED = 201;
    public const NOT_MODIFIED = 304;
    public const BAD_REQUEST = 400; // не верный запрос
    public const UNAUTHORIZED = 401; // не авторизован
    public const FORBIDDEN = 403; // запрещено
    public const NOT_FOUND = 404;
    public const INTERNAL_SERVER_ERROR = 500;
    public const SERVICE_UNAVAILABLE = 503; // сервис недоступен
}
