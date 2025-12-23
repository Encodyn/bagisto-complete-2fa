<x-admin::layouts>
    <x-slot:title>
        @lang('twofactorauth::app.admin.2fa.logs.title', ['name' => $admin->name])
    </x-slot>

    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            @lang('twofactorauth::app.admin.2fa.logs.title', ['name' => $admin->name])
        </p>

        <a href="{{ route('admin.settings.users.index') }}"
           class="primary-button">
            @lang('twofactorauth::app.admin.2fa.logs.back')
        </a>
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-900 rounded">
            <thead>
            <tr class="bg-gray-50 dark:bg-gray-800">
                <th class="px-4 py-3 text-left">@lang('twofactorauth::app.admin.2fa.logs.date')</th>
                <th class="px-4 py-3 text-left">@lang('twofactorauth::app.admin.2fa.logs.action')</th>
                <th class="px-4 py-3 text-left">@lang('twofactorauth::app.admin.2fa.logs.ip')</th>
                <th class="px-4 py-3 text-left">@lang('twofactorauth::app.admin.2fa.logs.performed_by')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($logs as $log)
                <tr class="border-b dark:border-gray-700">
                    <td class="px-4 py-3 text-sm">
                        {{ $log->created_at->format('Y-m-d H:i:s') }}
                        <span class="text-gray-500 text-xs">
                            ({{ $log->created_at->diffForHumans() }})
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @switch($log->action)
                            @case('enabled')
                                <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.enabled')
                                </span>
                                @break
                            @case('verified')
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.verified')
                                </span>
                                @break
                            @case('recovery_used')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.recovery_used')
                                </span>
                                @break
                            @case('cli_reset')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.cli_reset')
                                </span>
                                @break
                            @case('reset_by_admin')
                                <span class="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.reset_by_admin')
                                </span>
                                @break
                            @case('failed_attempt')
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200 rounded text-xs">
                                    @lang('twofactorauth::app.admin.2fa.logs.actions.failed_attempt')
                                </span>
                                @break
                        @endswitch
                    </td>
                    <td class="px-4 py-3 text-sm font-mono">
                        {{ $log->ip_address ?? 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($log->performedBy)
                            {{ $log->performedBy->name }}
                        @else
                            <span class="text-gray-500">{{ $admin->name }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                        @lang('twofactorauth::app.admin.2fa.logs.no_logs')
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        @if($logs->hasPages())
            <div class="flex items-center justify-end gap-6 px-6 py-3 border-t border-gray-200">
                @if ($logs->onFirstPage())
                    <span class="text-gray-400 text-lg">‹</span>
                @else
                    <a href="{{ $logs->previousPageUrl() }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white text-lg">‹</a>
                @endif

                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $logs->currentPage() }} / {{ $logs->lastPage() }}
                </span>

                @if ($logs->hasMorePages())
                    <a href="{{ $logs->nextPageUrl() }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white text-lg">›</a>
                @else
                    <span class="text-gray-400 text-lg">›</span>
                @endif
            </div>
        @endif
    </div>

</x-admin::layouts>
