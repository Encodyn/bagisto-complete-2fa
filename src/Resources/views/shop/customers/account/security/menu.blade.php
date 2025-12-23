<a href="{{ route('shop.customer.account.security.index') }}"
   class="{{ request()->routeIs('shop.customer.account.security.*') ? 'active' : '' }}">
    <span>{{ __('twofactorauth::app.shop.security.menu') }}</span>
</a>
