<?php

return [
    [
        'url' => '#^auth/register$#',
        'controller' => 'App\\Controllers\\Auth\\RegisterController@showRegisterForm',
    ],
    [
        'url' => '#^register$#',
        'controller' => 'App\\Controllers\\Auth\\RegisterController@register',
    ],
    [
        'url' => '#^auth/login#',
        'controller' => 'App\\Controllers\\Auth\\LoginController@showLoginForm',
    ],
    [
        'url' => '#^login#',
        'controller' => 'App\\Controllers\\Auth\\LoginController@login',
    ],
    [
        'url' => '#^dashboard$#',
        'controller' => 'App\\Controllers\\Shop\\DashboardController@index',
    ],
    [
        'url' => '#logout#',
        'controller' => 'App\\Controllers\\Auth\\LoginController@logout',
    ],
    [
        'url' => '#^$|^\?#',
        'controller' => 'App\\Controllers\\Shop\\ShopController@index',
    ],
];