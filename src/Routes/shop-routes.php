<?php

use Encodyn\TwoFactorAuth\Http\Controllers\Shop\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {

    Route::get('customer/2fa/reset/confirm', [TwoFactorAuthController::class, 'confirmReset'])
        ->name('shop.customer.2fa.reset.confirm');

    Route::group(['middleware' => ['customer']], function () {
        Route::controller(TwoFactorAuthController::class)->prefix('customer/2fa')->group(function () {
            Route::get('verify', 'showVerify')->name('shop.customer.2fa.verify');
            Route::post('verify', 'verify')->name('shop.customer.2fa.verify.post');
            Route::get('recovery', 'showRecovery')->name('shop.customer.2fa.recovery');
            Route::post('recovery', 'verifyRecovery')->name('shop.customer.2fa.recovery.post');

            Route::post('reset/send', 'sendResetLink')->name('shop.customer.2fa.reset.send');
        });
    });

    Route::group(['middleware' => ['customer']], function () {
        Route::prefix('customer/account/security')->group(function () {
            Route::controller(TwoFactorAuthController::class)->group(function () {
                Route::get('/', 'index')->name('shop.customer.account.security.index');
                Route::get('2fa/enable', 'showEnable')->name('shop.customer.account.security.2fa.enable');
                Route::post('2fa/enable', 'enable')->name('shop.customer.account.security.2fa.enable.post');
                Route::post('2fa/disable', 'disable')->name('shop.customer.account.security.2fa.disable');
            });
        });
    });
});
