<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('twofactorauth::app.shop.security.enable-2fa')
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
                class="md:hidden"
                href="{{ route('shop.customer.account.security.index') }}"
                >
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
                </a>

                <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                    @lang('twofactorauth::app.shop.security.enable-2fa')
                </h2>
            </div>
        </div>

        <!-- Setup Content -->
        <div class="mt-[60px] max-w-2xl max-md:mt-5">
            <x-shop::form :action="route('shop.customer.account.security.2fa.enable.post')">
                <!-- QR Code Section -->
                <div class="rounded-xl border border-zinc-200 p-6 mb-6">
                    <h3 class="text-lg font-medium mb-4">
                        @lang('twofactorauth::app.shop.security.scan-qr-title')
                    </h3>

                    <p class="text-sm text-zinc-600 mb-6">
                        @lang('twofactorauth::app.shop.security.scan-qr-description')
                    </p>

                    <!-- QR Code -->
                    <div class="flex justify-center mb-6">
                        <div class="rounded-lg border-2 border-gray-200 p-4 bg-white">
                            {!! $qrImage !!}
                        </div>
                    </div>

                    <!-- Manual Entry -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-medium text-gray-600 mb-2">
                            @lang('twofactorauth::app.shop.security.manual-entry')
                        </p>
                        <div class="flex items-center justify-between">
                            <code class="text-sm font-mono text-blue-600 select-all">
                                {{ $secret }}
                            </code>
                            <button
                                type="button"
                                onclick="copySecret()"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                            >
                                @lang('twofactorauth::app.shop.security.copy')
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Verification Code Input -->
                <div class="rounded-xl border border-zinc-200 p-6 mb-6">
                    <h3 class="text-lg font-medium mb-4">
                        @lang('twofactorauth::app.shop.security.verify-code-title')
                    </h3>

                    <p class="text-sm text-zinc-600 mb-4">
                        @lang('twofactorauth::app.shop.security.verify-code-description')
                    </p>

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('twofactorauth::app.shop.security.verification-code')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="code"
                            rules="required|numeric|digits:6"
                            :label="trans('twofactorauth::app.shop.security.verification-code')"
                            :placeholder="trans('twofactorauth::app.shop.security.enter-code')"
                            maxlength="6"
                            class="!w-48"
                        />

                        <x-shop::form.control-group.error control-name="code" />
                    </x-shop::form.control-group>
                </div>
                <!-- Actions -->
                <div class="flex gap-3 max-sm:flex-col-reverse">
                    <a
                        href="{{ route('shop.customer.account.security.index') }}"
                        class="secondary-button border-zinc-200 px-5 py-3 font-normal text-center max-md:rounded-lg max-md:py-2 max-sm:py-1.5 max-sm:text-sm"
                    >
                        @lang('twofactorauth::app.shop.security.cancel')
                    </a>

                    <button
                        type="submit"
                        class="primary-button px-5 py-3 font-normal max-md:rounded-lg max-md:py-2 max-sm:py-1.5 max-sm:text-sm"
                    >
                        @lang('twofactorauth::app.shop.security.enable-2fa-button')
                    </button>
                </div>
            </x-shop::form>
        </div>
    </div>

    @push('scripts')
        <script>
            function copySecret() {
                const secret = "{{ $secret }}";

                navigator.clipboard.writeText(secret).then(() => {
                }).catch(() => {
                });
            }
        </script>
    @endpush
</x-shop::layouts.account>
