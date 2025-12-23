<?php

namespace Encodyn\TwoFactorAuth\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webkul\User\Models\Admin;

class TwoFactorEnabledNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Admin $user,
        public string $ipAddress,
        public string $userAgent
    ) {}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->subject(trans('twofactorauth::app.email.2fa-enabled.subject'))
            ->view('twofactorauth::emails.admin.2fa-enabled', [
                'userName'  => $this->user->name,
                'email'     => $this->user->email,
                'ipAddress' => $this->ipAddress,
                'userAgent' => $this->userAgent,
                'enabledAt' => now()->format('Y-m-d H:i:s'),
            ]);
    }
}
