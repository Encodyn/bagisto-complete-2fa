<?php

namespace Encodyn\TwoFactorAuth\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webkul\User\Models\Admin;

class TwoFactorResetNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Admin $user,
        public Admin $resetBy
    ) {}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->subject(trans('twofactorauth::app.email.2fa-reset.subject'))
            ->view('twofactorauth::emails.admin.2fa-reset', [
                'userName'     => $this->user->name,
                'resetByName'  => $this->resetBy->name,
                'resetByEmail' => $this->resetBy->email,
                'resetAt'      => now()->format('Y-m-d H:i:s'),
            ]);
    }
}
