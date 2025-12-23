<x-admin::layouts.anonymous>
    <x-slot:title>
        @lang('twofactorauth::app.recovery-title')
    </x-slot>

    <div class="flex h-[100vh] items-center justify-center">
        <div class="flex flex-col items-center gap-5">
            @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
                <img class="h-10" src="{{ Storage::url($logo) }}" alt="{{ config('app.name') }}" />
            @else
                <img class="w-max" src="{{ bagisto_asset('images/logo.svg') }}" alt="{{ config('app.name') }}" />
            @endif

            <div class="box-shadow flex min-w-[350px] flex-col rounded-md bg-white dark:bg-gray-900">
                <x-admin::form :action="route('admin.2fa.recovery.post')">
                    <p class="p-4 text-xl font-bold text-gray-800 dark:text-white">
                        @lang('twofactorauth::app.recovery-title')
                    </p>

                    <div class="border-y p-4 dark:border-gray-800">
                        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                            @lang('twofactorauth::app.recovery-message')
                        </p>

                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                @lang('twofactorauth::app.verification-code')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="code"
                                rules="required"
                                class="w-full uppercase"
                                placeholder="ABCDE12345"
                                :label="trans('twofactorauth::app.verification-code')"
                                autofocus
                            />

                            <x-admin::form.control-group.error control-name="code" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="flex items-center justify-between p-4">
                        <a href="{{ route('admin.2fa.verify') }}" class="cursor-pointer text-xs font-semibold leading-6 text-blue-600">
                            @lang('twofactorauth::app.back-to-2fa')
                        </a>

                        <button type="submit" class="cursor-pointer rounded-md border border-blue-700 bg-blue-600 px-3.5 py-1.5 font-semibold text-gray-50">
                            @lang('twofactorauth::app.verify')
                        </button>
                    </div>
                </x-admin::form>
            </div>
        </div>
    </div>
</x-admin::layouts.anonymous>
