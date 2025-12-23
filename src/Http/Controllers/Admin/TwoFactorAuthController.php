<?php

namespace Encodyn\TwoFactorAuth\Http\Controllers\Admin;

use Encodyn\TwoFactorAuth\Mail\Admin\TwoFactorEnabledNotification;
use Encodyn\TwoFactorAuth\Mail\Admin\TwoFactorResetNotification;
use Encodyn\TwoFactorAuth\Models\TwoFactorLog;
use Encodyn\TwoFactorAuth\Traits\LogsTwoFactorActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\User\Models\Admin;

class TwoFactorAuthController extends Controller
{
    use LogsTwoFactorActivity;

    /**
     * Display setup page (first time)
     */
    public function showSetup()
    {
        $user = auth()->guard('admin')->user();

        if (! $user) {
            return redirect()->route('admin.session.create');
        }

        if ($user->google2fa_secret) {
            return redirect()->route('admin.2fa.verify');
        }

        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();

        session([
            '2fa_secret'         => $secret,
            '2fa_secret_expires' => now()->addMinutes(config('twofactorauth.qr_code_expiration', 10)),
        ]);

        $qrImage = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('twofactorauth::admin.2fa.setup', compact('qrImage', 'secret'));
    }

    /**
     * Confirm setup and save secret
     */
    public function confirmSetup(Request $request)
    {
        $user = auth()->guard('admin')->user();

        if (! $user) {
            return redirect()->route('admin.session.create');
        }

        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $secret = session('2fa_secret');

        if (! $secret) {
            return redirect()->route('admin.2fa.setup')
                ->withErrors(['code' => trans('twofactorauth::app.session-expired')]);
        }

        if (session('2fa_secret_expires') < now()) {
            return redirect()->route('admin.2fa.setup')
                ->withErrors(['code' => trans('twofactorauth::app.qr-expired')]);
        }

        $google2fa = app('pragmarx.google2fa');
        $verified = $google2fa->verifyGoogle2FA($secret, $request->code);

        if ($verified) {
            $user->google2fa_secret = encrypt($secret);
            $user->google2fa_enabled_at = now();

            $recoveryCodes = [];
            for ($i = 0; $i < 8; $i++) {
                $recoveryCodes[] = strtoupper(\Illuminate\Support\Str::random(10));
            }

            $user->two_factor_recovery_codes = encrypt(json_encode(array_map(function ($code) {
                return password_hash($code, PASSWORD_DEFAULT);
            }, $recoveryCodes)));

            $user->save();
            $this->log2FAActivity('enabled', $user->id);

            try {
                Mail::to($user->email)->send(
                    new TwoFactorEnabledNotification(
                        $user,
                        request()->ip(),
                        request()->userAgent() ?? 'unknown'
                    )
                );
            } catch (\Exception $e) {
                \Log::error('Error sending 2FA enabled email: '.$e->getMessage());
            }

            session()->forget(['2fa_secret', '2fa_secret_expires']);

            session(['2fa:verified' => true]);

            return view('twofactorauth::admin.2fa.recovery-codes', [
                'codes' => $recoveryCodes,
            ]);
        }

        $this->log2FAActivity('failed_attempt', $user->id);

        return back()->withErrors(['code' => trans('twofactorauth::app.invalid-code')]);
    }

    /**
     * Display verification page (login)
     */
    public function showVerify()
    {
        if (session('2fa:verified')) {
            return redirect()->route('admin.dashboard.index');
        }

        if (! session()->has('2fa:user:id')) {
            return redirect()->route('admin.session.create');
        }

        return view('twofactorauth::admin.2fa.verify');
    }

    /**
     * Verify OTP on login
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $userId = session('2fa:user:id');

        if (! $userId) {
            return redirect()->route('admin.session.create')
                ->withErrors(['error' => trans('twofactorauth::app.session-expired')]);
        }

        $user = Admin::find($userId);

        if (! $user || ! $user->google2fa_secret) {
            session()->forget('2fa:user:id');

            return redirect()->route('admin.session.create')
                ->withErrors(['error' => trans('twofactorauth::app.invalid-user')]);
        }

        if (! $user->status) {
            session()->forget('2fa:user:id');

            return redirect()->route('admin.session.create')
                ->withErrors(['error' => trans('twofactorauth::app.account-deactivated')]);
        }

        $secret = decrypt($user->google2fa_secret);
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyGoogle2FA($secret, $request->code)) {
            $this->log2FAActivity('verified', $user->id);

            return $this->completeLogin($user);
        }

        $this->log2FAActivity('failed_attempt', $user->id);

        return back()->withErrors(['code' => trans('twofactorauth::app.invalid-code')]);
    }

    /**
     * Complete the login process
     */
    private function completeLogin($user)
    {
        auth()->guard('admin')->loginUsingId($user->id);
        session()->regenerate();
        session()->forget([
            '2fa:user:id',
            '2fa:needs_setup',
            '2fa:needs_verify',
            '2fa_secret',
            '2fa_secret_expires',
        ]);
        session(['2fa:verified' => true]);

        if (! bouncer()->hasPermission('dashboard')) {
            $permissions = $user->role->permissions;

            foreach ($permissions as $permission) {
                if (bouncer()->hasPermission($permission)) {
                    $permissionDetails = collect(config('acl'))->firstWhere('key', $permission);

                    return redirect()->route($permissionDetails['route']);
                }
            }
        }

        return redirect()->intended(route('admin.dashboard.index'));
    }

    public function index()
    {
        return view('twofactorauth::admin.index');
    }

    /**
     * Reset 2FA for a specific user
     */
    public function resetUser($id)
    {
        $admin = Admin::findOrFail($id);
        $resetBy = auth()->guard('admin')->user();

        $admin->google2fa_secret = null;
        $admin->google2fa_enabled_at = null;
        $admin->two_factor_recovery_codes = null;
        $admin->save();

        $this->log2FAActivity('reset_by_admin', $admin->id, $resetBy->id);

        try {
            Mail::to($admin->email)->send(
                new TwoFactorResetNotification($admin, $resetBy)
            );
        } catch (\Exception $e) {
            \Log::error('Error sending 2FA reset email: '.$e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => trans('twofactorauth::app.reset-success'),
        ]);
    }

    public function showRecovery()
    {
        return view('twofactorauth::admin.2fa.recovery');
    }

    public function verifyRecovery(Request $request)
    {
        $request->validate(['code' => 'required']);
        $userId = session('2fa:user:id');
        $admin = Admin::find($userId);

        if (! $admin || ! $admin->two_factor_recovery_codes) {
            return back()->withErrors(['code' => trans('twofactorauth::app.no-recovery-codes')]);
        }

        $codes = json_decode(decrypt($admin->two_factor_recovery_codes), true);

        foreach ($codes as $index => $hashedCode) {
            if (password_verify(strtoupper($request->code), $hashedCode)) {

                $this->log2FAActivity('recovery_used', $admin->id);
                unset($codes[$index]);
                $remainingCodes = array_values($codes);
                $count = count($remainingCodes);

                if ($count === 0) {
                    $admin->google2fa_secret = null;
                    $admin->google2fa_enabled_at = null;
                    $admin->two_factor_recovery_codes = null;
                    $admin->save();

                    $this->log2FAActivity('reset_self', $admin->id);

                    session()->forget(['2fa:verified', '2fa:needs_verify']);

                    auth()->guard('admin')->login($admin);

                    session()->flash('warning', trans('twofactorauth::app.last-recovery-code-used'));

                    return redirect()->route('admin.2fa.setup');
                }

                $admin->two_factor_recovery_codes = encrypt(json_encode($remainingCodes));
                $admin->save();

                session()->flash('info', trans('twofactorauth::app.recovery-code-accepted', ['count' => $count]));

                return $this->completeLogin($admin);
            }
        }

        $this->log2FAActivity('failed_attempt', $admin->id);

        return back()->withErrors(['code' => trans('twofactorauth::app.invalid-recovery-code')]);
    }

    public function logs($adminId)
    {
        $admin = Admin::findOrFail($adminId);

        $logs = TwoFactorLog::where('admin_id', $adminId)
            ->with('performedBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('twofactorauth::admin.2fa.logs', compact('admin', 'logs'));
    }
}
