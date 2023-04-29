<?php
return [
    // [
    //     'icon' => 'nav nav-pills nav-sidebar flex-column',
    //     'route' => 'dashboard.dashboard',
    //     'title' => 'dashboard'
    // ],
    [
        'icon' => 'nav nav-pills nav-sidebar flex-column',
        'route' => 'categories.index',
        'title' => 'categories'
    ],
    [
        'icon' => 'nav nav-pills nav-sidebar flex-column',
        'route' => 'products.index',
        'title' => 'products'
    ],
    [
        'icon' => 'nav nav-pills nav-sidebar flex-column',
        'route' => 'stores.index',
        'title' => 'stores'
    ],
    [
        'icon' => 'nav nav-pills nav-sidebar flex-column',
        'route' => 'roles.index',
        'title' => 'roles',
        'active' => 'roles.*',
        // 'ability' => 'roles.view'
    ]


];
