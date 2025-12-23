<?php

use Encodyn\TwoFactorAuth\Http\Controllers\Admin\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => config('app.admin_url'),
    'middleware' => ['web'],
], function () {
    Route::controller(TwoFactorAuthController::class)->prefix('2fa')->group(function () {
        Route::get('setup', 'showSetup')->name('admin.2fa.setup');

        Route::post('setup', 'confirmSetup')
            ->middleware('throttle:5,1')
            ->name('admin.2fa.confirm');

        Route::get('verify', 'showVerify')->name('admin.2fa.verify');

        Route::post('verify', 'verify')
            ->middleware('throttle:5,1')
            ->name('admin.2fa.verify.post');

        Route::get('reset/{id}', 'resetUser')
            ->name('admin.2fa.reset_user')
            ->middleware(['admin']);

        Route::get('recovery', 'showRecovery')->name('admin.2fa.recovery');
        Route::post('recovery', 'verifyRecovery')->name('admin.2fa.recovery.post');

        Route::get('logs/{id}', [TwoFactorAuthController::class, 'logs'])
            ->name('admin.2fa.logs');

    });

    Route::get('twofactorauth', [TwoFactorAuthController::class, 'index'])
        ->name('admin.twofactorauth.index');

});
