<x-admin::layouts.anonymous>
    <x-slot:title>
        @lang('twofactorauth::app.setup-title')
    </x-slot>

    <div class="flex h-[100vh] items-center justify-center">
        <div class="flex flex-col items-center gap-5">
            @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
                <img class="h-10" src="{{ Storage::url($logo) }}" alt="{{ config('app.name') }}" />
            @else
                <img class="w-max" src="{{ bagisto_asset('images/logo.svg') }}" alt="{{ config('app.name') }}" />
            @endif

            <div class="box-shadow flex min-w-[400px] flex-col rounded-md bg-white dark:bg-gray-900">
                <x-admin::form :action="route('admin.2fa.confirm')">
                    <p class="p-4 text-xl font-bold text-gray-800 dark:text-white">
                        @lang('twofactorauth::app.setup-title')
                    </p>

                    <div class="border-y p-4 dark:border-gray-800">
                        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                            @lang('twofactorauth::app.scan-qr')
                        </p>

                        <div class="mb-4 flex justify-center">
                            <div class="rounded-lg border border-gray-300 p-4 dark:border-gray-700">
                                {!! $qrImage !!}
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                                @lang('twofactorauth::app.manual-entry')
                            </p>
                            <code class="block rounded bg-gray-100 p-2 text-center text-sm dark:bg-gray-800">
                                {{ $secret }}
                            </code>
                        </div>

                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                @lang('twofactorauth::app.verification-code')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                class="w-full"
                                id="code"
                                name="code"
                                rules="required|numeric"
                                :label="trans('twofactorauth::app.verification-code')"
                                :placeholder="trans('twofactorauth::app.enter-code')"
                                maxlength="6"
                            />

                            <x-admin::form.control-group.error control-name="code" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="flex items-center justify-end p-4">
                        <button class="cursor-pointer rounded-md border border-blue-700 bg-blue-600 px-3.5 py-1.5 font-semibold text-gray-50" type="submit">
                            @lang('twofactorauth::app.enable-2fa')
                        </button>
                    </div>
                </x-admin::form>
            </div>
        </div>
    </div>
</x-admin::layouts.anonymous>
