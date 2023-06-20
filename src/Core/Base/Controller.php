<?php
declare(strict_types=1);

namespace App\Core\Base;

use App\Core\Config;
use App\Core\Http\Request;

abstract class Controller
{
    protected Request $request;
    protected Config $config;
    protected View $view;

    public function __construct(Request $request, Config $config)
    {
        $this->request = $request;
        $this->config = $config;
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
