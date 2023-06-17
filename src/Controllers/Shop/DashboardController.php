<?php
declare(strict_types=1);

namespace App\Controllers\Shop;

class DashboardController extends BaseController
{
    public function index(): string
    {
        return $this->view->render('shop/home/dashboard');
    }
}
