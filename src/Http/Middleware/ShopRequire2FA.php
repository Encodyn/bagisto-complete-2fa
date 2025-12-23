<?php

namespace Encodyn\TwoFactorAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShopRequire2FA
{
    protected array $allowedRoutes = [
        'shop.customer.session.destroy',
        'shop.customer.2fa.verify',
        'shop.customer.2fa.verify.post',
        'shop.customer.2fa.recovery',
        'shop.customer.2fa.recovery.post',
        'shop.customer.2fa.reset.send',
        'shop.customer.2fa.reset.confirm',
    ];

    public function handle(Request $request, Closure $next)
    {
        // Ignorar rutas de admin
        if ($request->is('admin/*') || $request->is('admin')) {
            return $next($request);
        }

        // Solo verificar si hay un customer logueado en el guard 'customer'
        if (! auth()->guard('customer')->check()) {
            return $next($request);
        }

        $customer = auth()->guard('customer')->user();

        if (! $customer->google2fa_secret) {
            return $next($request);
        }

        if (session('2fa:customer:verified')) {
            return $next($request);
        }

        $currentRoute = $request->route()?->getName();

        if ($currentRoute && in_array($currentRoute, $this->allowedRoutes)) {
            return $next($request);
        }

        return redirect()->route('shop.customer.2fa.verify');
    }
}
