<?php

$menus = config('menu.admin', []);

$lastSort = collect($menus)->max('sort') ?? 0;

return [
    [
        'key'   => 'twofactorauth',
        'name'  => 'TwoFactorAuth',
        'route' => 'admin.twofactorauth.index',
        'sort'  => $lastSort + 1,
        'icon'  => 'icon-sales',
    ],
];
