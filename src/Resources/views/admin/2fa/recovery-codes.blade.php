<x-admin::layouts.anonymous>
    <x-slot:title>
        @lang('twofactorauth::app.recovery-codes-title')
    </x-slot>

    <div class="flex h-[100vh] items-center justify-center">
        <div class="flex flex-col items-center gap-5">
            @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
                <img class="h-10" src="{{ Storage::url($logo) }}" alt="{{ config('app.name') }}" />
            @else
                <img class="w-max" src="{{ bagisto_asset('images/logo.svg') }}" alt="{{ config('app.name') }}" />
            @endif

            <div class="box-shadow flex min-w-[450px] flex-col rounded-md bg-white dark:bg-gray-900">
                <div class="p-4">
                    <div class="mb-2">
                        <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h2 class="text-center text-xl font-bold text-gray-800 dark:text-white">
                        @lang('twofactorauth::app.2fa-success')
                    </h2>
                </div>

                <div class="border-y p-4 dark:border-gray-800">
                    <p class="mb-4 text-center text-sm text-gray-600 dark:text-gray-300">
                        @lang('twofactorauth::app.save-codes-message')
                    </p>

                    <div class="mb-4 rounded-md border-2 border-yellow-400 bg-yellow-50 p-3 dark:bg-yellow-900/20">
                        <p class="text-xs font-semibold text-yellow-800 dark:text-yellow-200">
                            @lang('twofactorauth::app.codes-warning')
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 rounded-md border border-dashed border-gray-300 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                        @foreach ($codes as $code)
                            <code class="font-mono text-sm text-blue-600 dark:text-blue-400">{{ $code }}</code>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col gap-3 p-4">
                    <button
                        onclick="window.print()"
                        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                    >
                        @lang('twofactorauth::app.print-codes')
                    </button>

                    <button
                        onclick="copyCodes()"
                        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                    >
                        @lang('twofactorauth::app.copy-codes')
                    </button>

                    <a
                        href="{{ route('admin.dashboard.index') }}"
                        class="block w-full rounded-md border border-blue-700 bg-blue-600 px-4 py-3 text-center font-semibold text-white hover:bg-blue-700"
                    >
                        @lang('twofactorauth::app.continue-dashboard')
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyCodes() {
                const codes = @json($codes);
                const text = codes.join('\n');

                navigator.clipboard.writeText(text).then(() => {
                    const btn = event.target;
                    const originalText = btn.innerHTML;
                }).catch(() => {
                });
            }
        </script>
    @endpush

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .box-shadow, .box-shadow * {
                visibility: visible;
            }
            .box-shadow {
                position: absolute;
                left: 0;
                top: 0;
            }
            button, a {
                display: none !important;
            }
        }
    </style>
</x-admin::layouts.anonymous>
