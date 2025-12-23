<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('twofactorauth::app.shop.security.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="security" />
        @endSection
    @endif

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <!-- Back Button -->
                <a
                class="grid md:hidden"
                href="{{ route('shop.customers.account.index') }}"
                >
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
                </a>

                <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                    @lang('twofactorauth::app.shop.security.title')
                </h2>
            </div>
        </div>

        <!-- Security Content -->
        <div class="mt-[60px] max-md:mt-5">
            @if($customer->google2fa_secret)
                {{-- 2FA Enabled --}}
                <div class="rounded-xl border border-green-300 bg-green-50 p-6 mb-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-green-800 mb-2">
                                @lang('twofactorauth::app.shop.security.2fa-enabled')
                            </h3>
                            <p class="text-sm text-green-700">
                                @lang('twofactorauth::app.shop.security.2fa-enabled-description')
                            </p>
                            <p class="text-xs text-green-600 mt-2">
                                @lang('twofactorauth::app.shop.security.enabled-at'): {{ \Carbon\Carbon::parse($customer->google2fa_enabled_at)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3 max-sm:flex-col">
                        <x-shop::form
                            method="POST"
                            action="{{ route('shop.customer.account.security.2fa.disable') }}"
                        >
                            <x-shop::modal ref="confirmDisable2FA">
                                <x-slot:toggle>
                                    <button
                                        type="button"
                                        class="secondary-button border-red-300 px-5 py-3 font-normal text-red-600 hover:bg-red-50"
                                    >
                                        @lang('twofactorauth::app.shop.security.disable-2fa')
                                    </button>
                                </x-slot>

                                <x-slot:header>
                                    <h3 class="text-lg font-semibold">
                                        @lang('twofactorauth::app.shop.security.confirm-disable')
                                    </h3>
                                </x-slot>

                                <x-slot:content>
                                    <div class="p-4">
                                        <p class="mb-4">@lang('twofactorauth::app.shop.security.enter-password')</p>
                                        <x-shop::form.control-group>
                                            <x-shop::form.control-group.control
                                                type="password"
                                                name="password"
                                                rules="required"
                                                :placeholder="trans('twofactorauth::app.shop.security.password')"
                                            />
                                            <x-shop::form.control-group.error control-name="password" />
                                        </x-shop::form.control-group>
                                    </div>
                                </x-slot>

                                <x-slot:footer>
                                    <button
                                        type="submit"
                                        class="primary-button px-5 py-3"
                                    >
                                        @lang('twofactorauth::app.shop.security.confirm')
                                    </button>
                                </x-slot>
                            </x-shop::modal>
                        </x-shop::form>
                    </div>
                </div>
            @else
                {{-- 2FA Disabled --}}
                <div class="rounded-xl border border-yellow-300 bg-yellow-50 p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-yellow-800 mb-2">
                                @lang('twofactorauth::app.shop.security.2fa-disabled')
                            </h3>
                            <p class="text-sm text-yellow-700 mb-4">
                                @lang('twofactorauth::app.shop.security.2fa-disabled-description')
                            </p>
                        </div>
                    </div>

                    <a
                        href="{{ route('shop.customer.account.security.2fa.enable') }}"
                        class="secondary-button border-zinc-200 px-5 py-3 font-normal max-md:rounded-lg max-md:py-2 max-sm:py-1.5 max-sm:text-sm"
                    >
                        @lang('twofactorauth::app.shop.security.enable-2fa')
                    </a>
                </div>
            @endif

            <!-- Additional Security Info -->
            <div class="mt-6 rounded-xl border border-zinc-200 p-6">
                <h3 class="text-lg font-medium mb-3">
                    @lang('twofactorauth::app.shop.security.what-is-2fa')
                </h3>
                <p class="text-sm text-zinc-600">
                    @lang('twofactorauth::app.shop.security.2fa-description')
                </p>
            </div>
        </div>
    </div>
</x-shop::layouts.account>
