<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('twofactorauth::app.shop.security.verify-title')"/>
    <meta name="keywords" content="@lang('twofactorauth::app.shop.security.verify-title')"/>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('twofactorauth::app.shop.security.verify-title')
    </x-slot>

    <div class="container mt-20 max-1180:px-5 max-md:mt-12">
        <!-- Company Logo -->
        <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="{{ config('app.name') }}"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
            </a>
        </div>

        <!-- Form Container -->
        <div class="m-auto w-full max-w-[870px] rounded-xl border border-zinc-200 p-16 px-[90px] max-md:px-8 max-md:py-8 max-sm:border-none max-sm:p-0">
            <h1 class="font-dmserif text-4xl max-md:text-3xl max-sm:text-xl">
                @lang('twofactorauth::app.shop.security.verify-title')
            </h1>

            <p class="mt-4 text-xl text-zinc-500 max-sm:mt-0 max-sm:text-sm">
                @lang('twofactorauth::app.shop.security.verify-description')
            </p>

            <div class="mt-14 rounded max-sm:mt-8">
                <x-shop::form :action="route('shop.customer.2fa.verify.post')">

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('twofactorauth::app.shop.security.verification-code')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="px-6 py-4 max-md:py-3 max-sm:py-2"
                            name="code"
                            rules="required|numeric|digits:6"
                            :label="trans('twofactorauth::app.shop.security.verification-code')"
                            placeholder="000000"
                            maxlength="6"
                            autofocus
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="code" />
                    </x-shop::form.control-group>

                    <div class="mt-8 flex flex-wrap items-center gap-9 max-sm:justify-center max-sm:gap-5 max-sm:text-center">
                        <button
                            class="primary-button m-0 mx-auto block w-full max-w-[374px] rounded-2xl px-11 py-4 text-center text-base max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5 ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('twofactorauth::app.shop.security.verify-button')
                        </button>
                    </div>
                </x-shop::form>
            </div>

            <p class="mt-5 font-medium text-zinc-500 max-sm:text-center max-sm:text-sm">
                @lang('twofactorauth::app.shop.security.lost-device')

                <a
                    class="text-navyBlue"
                    href="{{ route('shop.customer.2fa.recovery') }}"
                >
                    @lang('twofactorauth::app.shop.security.use-recovery-code')
                </a>
            </p>
        </div>

        <p class="mb-4 mt-8 text-center text-xs text-zinc-500">
            @lang('shop::app.customers.login-form.footer', ['current_year'=> date('Y') ])
        </p>
    </div>
</x-shop::layouts>
