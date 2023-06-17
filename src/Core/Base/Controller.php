<?php
declare(strict_types=1);

namespace App\Core\Base;

use App\Core\Http\Request;

abstract class Controller
{
    protected Request $request;
    protected View $view;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    protected function redirect(string $http =''): never
    {
        if ($http) {
            $redirect = '/' . ltrim($http, '/');
        } else {
            $redirect = $_SERVER['HTTP_REFERER'] ?? '/';
        }

        header("location: {$redirect}");
        die;
    }
}
