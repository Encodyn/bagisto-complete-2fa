<?php

$menus = config('menu.customer', []);

$lastSort = collect($menus)->max('sort') ?? 0;

return [
    [
        'key'   => 'account.security',
        'name'  => 'twofactorauth::app.shop.security.menu',
        'route' => 'shop.customer.account.security.index',
        'icon'  => 'icon-gdpr-safe',
        'sort'  => $lastSort + 1,
    ],
];
