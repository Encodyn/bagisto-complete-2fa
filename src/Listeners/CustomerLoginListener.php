<?php

namespace Encodyn\TwoFactorAuth\Listeners;

use Illuminate\Auth\Events\Login;

class CustomerLoginListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        if ($event->guard !== 'customer') {
            return;
        }

        $customer = $event->user;

        if (! $customer || ! $customer->google2fa_secret) {
            session(['2fa:customer:verified' => true]);

            return;
        }

        session()->forget('2fa:customer:verified');

        session(['url.intended' => route('shop.customer.2fa.verify')]);
    }
}
