<?php

namespace Encodyn\TwoFactorAuth\Mail\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webkul\Customer\Models\Customer;

class TwoFactorResetLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Customer $customer,
        public string $resetUrl,
        public int $expiresInMinutes = 10
    ) {}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->subject(trans('twofactorauth::app.email.shop.2fa-reset-link.subject'))
            ->view('twofactorauth::emails.shop.2fa-reset-link', [
                'customerName'     => $this->customer->name,
                'resetUrl'         => $this->resetUrl,
                'expiresInMinutes' => $this->expiresInMinutes,
            ]);
    }
}
