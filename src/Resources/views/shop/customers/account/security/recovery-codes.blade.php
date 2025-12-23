<x-shop::layouts.account>
    <x-slot:title>
        @lang('twofactorauth::app.shop.security.recovery-codes-title')
    </x-slot>

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto">
        <div class="flex items-center">
            <a
            class="md:hidden"
            href="{{ route('shop.customer.account.security.index') }}"
            >
            <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
            </a>

            <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                @lang('twofactorauth::app.shop.security.recovery-codes-title')
            </h2>
        </div>

        <div class="mt-[60px] max-w-2xl max-md:mt-5">
            <!-- Success Message -->
            <div class="rounded-xl border border-green-300 bg-green-50 p-6 mb-6">
                <div class="flex items-center gap-3 mb-3">
                    <h3 class="text-lg font-medium text-green-800">
                        @lang('twofactorauth::app.shop.security.2fa-enabled-success')
                    </h3>
                </div>
                <p class="text-sm text-green-700">
                    @lang('twofactorauth::app.shop.security.2fa-enabled-success-description')
                </p>
            </div>

            <!-- Warning -->
            <div class="rounded-xl border-2 border-yellow-300 bg-yellow-50 p-4 mb-6">
                <div class="flex gap-3">
                    <div>
                        <p class="text-sm font-semibold text-yellow-800 mb-1">
                            @lang('twofactorauth::app.shop.security.save-codes-warning')
                        </p>
                        <p class="text-xs text-yellow-700">
                            @lang('twofactorauth::app.shop.security.codes-warning-description')
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recovery Codes -->
            <div class="rounded-xl border border-zinc-200 p-6 mb-6">
                <h3 class="text-lg font-medium mb-4">
                    @lang('twofactorauth::app.shop.security.your-recovery-codes')
                </h3>

                <div class="grid grid-cols-2 gap-3 rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-4 mb-4">
                    @foreach ($codes as $code)
                        <code class="font-mono text-sm text-blue-600">{{ $code }}</code>
                    @endforeach
                </div>

                <div class="flex gap-3 max-sm:flex-col">
                    <button
                        onclick="printCodes()"
                        class="secondary-button border-zinc-200 px-5 py-3 font-normal max-md:rounded-lg max-md:py-2"
                    >
                        @lang('twofactorauth::app.shop.security.print-codes')
                    </button>

                    <button
                        onclick="copyCodes()"
                        class="secondary-button border-zinc-200 px-5 py-3 font-normal max-md:rounded-lg max-md:py-2"
                    >
                        @lang('twofactorauth::app.shop.security.copy-codes')
                    </button>
                </div>
            </div>

            <!-- Continue -->
            <a
            href="{{ route('shop.customer.account.security.index') }}"
            class="primary-button block w-full px-5 py-3 text-center max-md:rounded-lg max-md:py-2"
            >
            @lang('twofactorauth::app.shop.security.continue-to-account')
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyCodes() {
                const codes = @json($codes);
                const text = codes.join('\n');

                navigator.clipboard.writeText(text).then(() => {
                }).catch(() => {
                });
            }

            function printCodes() {
                window.print();
            }
        </script>
    @endpush

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .flex-auto, .flex-auto * {
                visibility: visible;
            }
            .flex-auto {
                position: absolute;
                left: 0;
                top: 0;
            }
            button, a.primary-button {
                display: none !important;
            }
        }
    </style>
</x-shop::layouts.account>
