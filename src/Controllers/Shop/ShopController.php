<?php
declare(strict_types=1);

namespace App\Controllers\Shop;

class ShopController extends BaseController
{
    public function index(): string
    {
        return $this->view->render('shop/home/index');
    }
}
