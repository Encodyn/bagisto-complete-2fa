<?php

namespace Encodyn\TwoFactorAuth\Mail\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webkul\Customer\Models\Customer;

class TwoFactorEnabledNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Customer $customer,
        public string $ipAddress,
        public string $userAgent
    ) {}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->subject(trans('twofactorauth::app.email.shop.2fa-enabled.subject'))
            ->view('twofactorauth::emails.shop.2fa-enabled', [
                'customerName' => $this->customer->name,
                'email'        => $this->customer->email,
                'ipAddress'    => $this->ipAddress,
                'userAgent'    => $this->userAgent,
                'enabledAt'    => now()->format('Y-m-d H:i:s'),
            ]);
    }
}
