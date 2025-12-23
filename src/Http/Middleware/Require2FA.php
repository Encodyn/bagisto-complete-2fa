<?php

namespace Encodyn\TwoFactorAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Require2FA
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs('admin.2fa.*')) {
            return $next($request);
        }

        if (! auth()->guard('admin')->check()) {
            return $next($request);
        }

        $user = auth()->guard('admin')->user();

        if (session()->get('2fa:verified') === true) {
            return $next($request);
        }

        if (session()->has('2fa:needs_setup') || ! $user->google2fa_secret) {
            return redirect()->route('admin.2fa.setup');
        }

        if (session()->has('2fa:needs_verify') || $user->google2fa_secret) {
            session(['2fa:user:id' => $user->id]);

            return redirect()->route('admin.2fa.verify');
        }

        return $next($request);
    }
}
