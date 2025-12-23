@component('shop::emails.layout')
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px; font-weight: 600; color: #121A26">
            @lang('twofactorauth::app.email.2fa-enabled.greeting', ['name' => $userName])
        </span>
    </div>

    <div style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.2fa-enabled.message')
        </p>

        <div style="background-color: #f8f9fa; border-left: 4px solid #28a745; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #28a745;">
                @lang('twofactorauth::app.email.2fa-enabled.success-title')
            </p>
        </div>

        <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; background-color: #f8f9fa; font-weight: 600; width: 150px;">
                    @lang('twofactorauth::app.email.2fa-enabled.enabled-at'):
                </td>
                <td style="padding: 8px; background-color: #f8f9fa;">
                    {{ $enabledAt }}
                </td>
            </tr>
            <tr>
                <td style="padding: 8px; font-weight: 600;">
                    @lang('twofactorauth::app.email.2fa-enabled.ip-address'):
                </td>
                <td style="padding: 8px;">
                    {{ $ipAddress }}
                </td>
            </tr>
            <tr>
                <td style="padding: 8px; background-color: #f8f9fa; font-weight: 600;">
                    @lang('twofactorauth::app.email.2fa-enabled.device'):
                </td>
                <td style="padding: 8px; background-color: #f8f9fa;">
                    {{ $userAgent }}
                </td>
            </tr>
        </table>

        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #856404;">
                @lang('twofactorauth::app.email.2fa-enabled.warning-title')
            </p>
            <p style="margin: 10px 0 0 0; color: #856404;">
                @lang('twofactorauth::app.email.2fa-enabled.warning-message')
            </p>
        </div>

        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px; margin-top: 20px;">
            @lang('twofactorauth::app.email.2fa-enabled.backup-codes')
        </p>

        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.2fa-enabled.closing')
        </p>
    </div>
@endcomponent
