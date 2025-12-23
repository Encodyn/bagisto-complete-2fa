<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('customer.account', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(trans('twofactorauth::app.shop.security.account'), route('shop.customers.account.index'));
});

Breadcrumbs::for('security', function (BreadcrumbTrail $trail) {
    $trail->parent('customer.account');
    $trail->push(trans('twofactorauth::app.shop.security.title'), route('shop.customer.account.security.index'));
});
