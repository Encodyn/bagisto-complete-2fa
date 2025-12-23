<?php

namespace Encodyn\TwoFactorAuth\Listeners;

use Illuminate\Auth\Events\Login;

class AdminLoginListener
{
    public function handle(Login $event)
    {
        if ($event->guard !== 'admin') {
            return;
        }

        $user = $event->user;

        session()->forget('2fa:verified');

        if (! $user->google2fa_secret) {
            session([
                '2fa:user:id'      => $user->id,
                '2fa:needs_setup'  => true,
            ]);

            return;
        }

        session([
            '2fa:user:id'      => $user->id,
            '2fa:needs_verify' => true,
        ]);
    }
}
