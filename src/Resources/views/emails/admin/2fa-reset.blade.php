@component('shop::emails.layout')
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px; font-weight: 600; color: #121A26">
            @lang('twofactorauth::app.email.2fa-reset.greeting', ['name' => $userName])
        </span>
    </div>

    <div style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
        <div style="background-color: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #721c24;">
                @lang('twofactorauth::app.email.2fa-reset.alert-title')
            </p>
            <p style="margin: 10px 0 0 0; color: #721c24;">
                @lang('twofactorauth::app.email.2fa-reset.alert-message')
            </p>
        </div>

        <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; background-color: #f8f9fa; font-weight: 600; width: 150px;">
                    @lang('twofactorauth::app.email.2fa-reset.reset-by'):
                </td>
                <td style="padding: 8px; background-color: #f8f9fa;">
                    {{ $resetByName }} ({{ $resetByEmail }})
                </td>
            </tr>
            <tr>
                <td style="padding: 8px; font-weight: 600;">
                    @lang('twofactorauth::app.email.2fa-reset.reset-at'):
                </td>
                <td style="padding: 8px;">
                    {{ $resetAt }}
                </td>
            </tr>
        </table>

        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.2fa-reset.next-steps')
        </p>

        <div style="background-color: #d1ecf1; border-left: 4px solid #0c5460; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #0c5460;">
                @lang('twofactorauth::app.email.2fa-reset.info-title')
            </p>
            <ul style="margin: 10px 0 0 0; padding-left: 20px; color: #0c5460;">
                <li>@lang('twofactorauth::app.email.2fa-reset.step-1')</li>
                <li>@lang('twofactorauth::app.email.2fa-reset.step-2')</li>
                <li>@lang('twofactorauth::app.email.2fa-reset.step-3')</li>
            </ul>
        </div>

        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #856404;">
                @lang('twofactorauth::app.email.2fa-reset.warning-title')
            </p>
            <p style="margin: 10px 0 0 0; color: #856404;">
                @lang('twofactorauth::app.email.2fa-reset.warning-message')
            </p>
        </div>

        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.2fa-reset.closing')
        </p>
    </div>
@endcomponent
