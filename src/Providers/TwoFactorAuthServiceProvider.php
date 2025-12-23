<?php

namespace Encodyn\TwoFactorAuth\Providers;

use Encodyn\TwoFactorAuth\Console\Commands\Reset2FA;
use Encodyn\TwoFactorAuth\Listeners\AdminLoginListener;
use Encodyn\TwoFactorAuth\Listeners\CustomerLoginListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TwoFactorAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();
    }

    public function boot(Router $router): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/admin-routes.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/shop-routes.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/breadcrumbs.php');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'twofactorauth');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'twofactorauth');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Resources/views/admin/settings/users/index.blade.php' => resource_path('views/vendor/admin/settings/users/index.blade.php'),
            ], 'twofactorauth-views');
        }

        $this->app->view->prependNamespace('admin', [
            resource_path('views/vendor/admin'),
            __DIR__.'/../Resources/views/admin',
        ]);


        $router->aliasMiddleware('admin.2fa', \Encodyn\TwoFactorAuth\Http\Middleware\Require2FA::class);
        $router->pushMiddlewareToGroup('admin', \Encodyn\TwoFactorAuth\Http\Middleware\Require2FA::class);

        $router->aliasMiddleware('customer.2fa', \Encodyn\TwoFactorAuth\Http\Middleware\ShopRequire2FA::class);
        $router->pushMiddlewareToGroup('web', \Encodyn\TwoFactorAuth\Http\Middleware\ShopRequire2FA::class);

        $this->app['events']->listen(Login::class, function ($event) {
            if ($event->guard === 'admin') {
                app(AdminLoginListener::class)->handle($event);
            } elseif ($event->guard === 'customer') {
                app(CustomerLoginListener::class)->handle($event);
            }
        });

        $this->app['events']->listen(Logout::class, function ($event) {
            if ($event->guard === 'admin') {
                session()->forget([
                    '2fa:verified',
                    '2fa:user:id',
                    '2fa:needs_setup',
                    '2fa:needs_verify',
                ]);
            } elseif ($event->guard === 'customer') {
                session()->forget([
                    '2fa:customer:verified',
                ]);
            }
        });

        if ($this->app->runningInConsole()) {
            $this->commands([Reset2FA::class]);
        }
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/menu.php', 'menu.customer');
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/twofactorauth.php', 'twofactorauth');
    }
}
