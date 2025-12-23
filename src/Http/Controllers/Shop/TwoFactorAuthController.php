<?php

namespace Encodyn\TwoFactorAuth\Http\Controllers\Shop;

use Encodyn\TwoFactorAuth\Mail\Shop\TwoFactorEnabledNotification;
use Encodyn\TwoFactorAuth\Mail\Shop\TwoFactorResetLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Webkul\Customer\Models\Customer;
use Webkul\Shop\Http\Controllers\Controller;

class TwoFactorAuthController extends Controller
{
    /**
     * Show security settings page
     */
    public function index()
    {
        $customer = auth()->guard('customer')->user();

        return view('twofactorauth::shop.customers.account.security.index', compact('customer'));
    }

    /**
     * Show 2FA enable page
     */
    public function showEnable()
    {
        $customer = auth()->guard('customer')->user();

        if ($customer->google2fa_secret) {
            return redirect()->route('shop.customer.account.security.index')
                ->with('warning', trans('twofactorauth::app.shop.security.already-enabled'));
        }

        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();

        session([
            '2fa_secret'         => $secret,
            '2fa_secret_expires' => now()->addMinutes(15),
        ]);

        $qrImage = $google2fa->getQRCodeInline(
            config('app.name'),
            $customer->email,
            $secret
        );

        return view('twofactorauth::shop.customers.account.security.enable', compact('qrImage', 'secret'));
    }

    /**
     * Enable 2FA
     */
    public function enable(Request $request)
    {
        $customer = auth()->guard('customer')->user();

        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $secret = session('2fa_secret');

        if (! $secret || session('2fa_secret_expires') < now()) {
            return back()->withErrors(['code' => trans('twofactorauth::app.session-expired')]);
        }

        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyGoogle2FA($secret, $request->code)) {
            $recoveryCodes = [];
            for ($i = 0; $i < 8; $i++) {
                $recoveryCodes[] = strtoupper(\Illuminate\Support\Str::random(10));
            }

            $customer->google2fa_secret = encrypt($secret);
            $customer->google2fa_enabled_at = now();
            $customer->two_factor_recovery_codes = encrypt(json_encode(array_map(function ($code) {
                return password_hash($code, PASSWORD_DEFAULT);
            }, $recoveryCodes)));
            $customer->save();

            session()->forget(['2fa_secret', '2fa_secret_expires']);

            try {
                Mail::to($customer->email)->send(
                    new TwoFactorEnabledNotification(
                        $customer,
                        request()->ip(),
                        request()->userAgent() ?? 'Unknown'
                    )
                );
            } catch (\Exception $e) {
                \Log::error('Error sending 2FA enabled email to customer: '.$e->getMessage());
            }

            return view('twofactorauth::shop.customers.account.security.recovery-codes', [
                'codes' => $recoveryCodes,
            ]);
        }

        return back()->withErrors(['code' => trans('twofactorauth::app.invalid-code')]);
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $customer = auth()->guard('customer')->user();

        $request->validate([
            'password' => 'required',
        ]);

        if (! \Hash::check($request->password, $customer->password)) {
            session()->flash('error', trans('twofactorauth::app.shop.security.invalid-password'));

            return redirect()->back();
        }

        $customer->google2fa_secret = null;
        $customer->google2fa_enabled_at = null;
        $customer->two_factor_recovery_codes = null;
        $customer->save();

        return redirect()->route('shop.customer.account.security.index')
            ->with('success', trans('twofactorauth::app.shop.security.2fa-disabled-success'));
    }

    /**
     * Show verification page (during login)
     */
    public function showVerify()
    {
        $customer = auth()->guard('customer')->user();

        if (! $customer) {
            return redirect()->route('shop.customer.session.create');
        }

        if (! $customer->google2fa_secret || session('2fa:customer:verified')) {
            return redirect()->route('shop.home.index');
        }

        return view('twofactorauth::shop.customers.account.security.verify');
    }

    /**
     * Verify OTP code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $customer = auth()->guard('customer')->user();

        if (! $customer || ! $customer->google2fa_secret) {
            return redirect()->route('shop.customer.session.create');
        }

        $secret = decrypt($customer->google2fa_secret);
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyGoogle2FA($secret, $request->code)) {
            session(['2fa:customer:verified' => true]);

            return redirect()->intended(route('shop.home.index'));
        }

        return back()->withErrors(['code' => trans('twofactorauth::app.invalid-code')]);
    }

    /**
     * Show recovery page
     */
    public function showRecovery()
    {
        $customer = auth()->guard('customer')->user();

        if (! $customer) {
            return redirect()->route('shop.customer.session.create');
        }

        if (! $customer->google2fa_secret || session('2fa:customer:verified')) {
            return redirect()->route('shop.home.index');
        }

        return view('twofactorauth::shop.customers.account.security.recovery');
    }

    /**
     * Verify recovery code
     */
    public function verifyRecovery(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $customer = auth()->guard('customer')->user();

        if (! $customer || ! $customer->two_factor_recovery_codes) {
            return back()->withErrors(['code' => trans('twofactorauth::app.shop.security.no-recovery-codes')]);
        }

        $codes = json_decode(decrypt($customer->two_factor_recovery_codes), true);
        $inputCode = strtoupper(str_replace(['-', ' '], '', $request->code));

        foreach ($codes as $index => $hashedCode) {
            if (password_verify($inputCode, $hashedCode)) {
                unset($codes[$index]);
                $remainingCodes = array_values($codes);
                $count = count($remainingCodes);

                if ($count === 0) {
                    $customer->google2fa_secret = null;
                    $customer->google2fa_enabled_at = null;
                    $customer->two_factor_recovery_codes = null;
                    $customer->save();

                    session(['2fa:customer:verified' => true]);

                    return redirect()->route('shop.customer.account.security.index')
                        ->with('error', trans('twofactorauth::app.shop.security.last-recovery-used'));

                }

                $customer->two_factor_recovery_codes = encrypt(json_encode($remainingCodes));
                $customer->save();

                session(['2fa:customer:verified' => true]);

                return redirect()->route('shop.home.index')
                    ->with('error', trans('twofactorauth::app.shop.security.recovery-used', ['count' => $count]));
            }
        }

        return back()->withErrors(['code' => trans('twofactorauth::app.shop.security.invalid-recovery-code')]);
    }

    /**
     * Send reset link via email
     */
    public function sendResetLink(Request $request)
    {
        $customer = auth()->guard('customer')->user();

        if (! $customer) {
            return redirect()->route('shop.customer.session.create');
        }

        if (! $customer->google2fa_secret) {
            return redirect()->route('shop.home.index');
        }

        // Generate signed URL that expires in 10 minutes
        $resetUrl = URL::temporarySignedRoute(
            'shop.customer.2fa.reset.confirm',
            now()->addMinutes(10),
            ['customer' => $customer->id]
        );

        try {
            Mail::to($customer->email)->send(
                new TwoFactorResetLink($customer, $resetUrl, 10)
            );

            session()->flash('success', trans('twofactorauth::app.email.shop.reset-link-sent'));
        } catch (\Exception $e) {
            \Log::error('Error sending 2FA reset link: '.$e->getMessage());
            session()->flash('error', trans('twofactorauth::app.email.shop.reset-link-error'));
        }

        return back();
    }

    /**
     * Confirm reset via email link
     */
    public function confirmReset(Request $request)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->route('shop.customer.session.create')
                ->with('error', trans('twofactorauth::app.email.shop.reset-link-invalid'));
        }

        $customerId = $request->query('customer');
        $customer = Customer::find($customerId);

        if (! $customer) {
            return redirect()->route('shop.customer.session.create')
                ->with('error', trans('twofactorauth::app.email.shop.reset-link-invalid'));
        }

        $customer->google2fa_secret = null;
        $customer->google2fa_enabled_at = null;
        $customer->two_factor_recovery_codes = null;
        $customer->save();

        $currentCustomer = auth()->guard('customer')->user();
        if ($currentCustomer && $currentCustomer->id === $customer->id) {
            session(['2fa:customer:verified' => true]);
        }

        return redirect()->route('shop.customer.account.security.index')
            ->with('success', trans('twofactorauth::app.email.shop.2fa-reset-success'));
    }
}
