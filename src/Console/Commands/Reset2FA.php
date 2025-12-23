<?php

namespace Encodyn\TwoFactorAuth\Console\Commands;

use Encodyn\TwoFactorAuth\Mail\Admin\TwoFactorResetNotification;
use Encodyn\TwoFactorAuth\Models\TwoFactorLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Webkul\User\Models\Admin;

class Reset2FA extends Command
{
    protected $signature = '2fa:reset {email}';

    protected $description = 'Reset 2FA for an admin user';

    public function handle()
    {
        $admin = Admin::where('email', $this->argument('email'))->first();

        if (! $admin) {
            $this->error('Admin not found!');

            return 1;
        }

        if (! $admin->google2fa_secret) {
            $this->info("2FA is not enabled for {$admin->name}");

            return 0;
        }

        $this->info("Resetting 2FA for: {$admin->name} ({$admin->email})");

        if (! $this->confirm('Continue?')) {
            return 0;
        }

        $admin->google2fa_secret = null;
        $admin->google2fa_enabled_at = null;
        $admin->two_factor_recovery_codes = null;
        $result = $admin->save();

        if ($result) {
            try {
                TwoFactorLog::create([
                    'admin_id'     => $admin->id,
                    'action'       => 'cli_reset',
                    'ip_address'   => '127.0.0.1',
                    'user_agent'   => 'CLI Reset Command',
                    'performed_by' => null,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            } catch (\Exception $e) {
                $this->warn('Could not log the action: '.$e->getMessage());
            }

            try {
                $cliAdmin = new Admin;
                $cliAdmin->name = 'System Administrator';
                $cliAdmin->email = 'system@cli';

                Mail::to($admin->email)->send(
                    new TwoFactorResetNotification($admin, $cliAdmin)
                );

                $this->info('Email notification sent');
            } catch (\Exception $e) {
                $this->warn('Could not send email: '.$e->getMessage());
            }

            $this->info('2FA reset successfully!');
        } else {
            $this->error('Failed to save changes');
        }

        return 0;
    }
}
