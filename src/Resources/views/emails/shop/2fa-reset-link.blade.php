@component('shop::emails.layout')
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px; font-weight: 600; color: #121A26">
            @lang('twofactorauth::app.email.shop.2fa-reset-link.greeting', ['name' => $customerName])
        </span>
    </div>

    <div style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.shop.2fa-reset-link.message')
        </p>

        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #856404;">
                @lang('twofactorauth::app.email.shop.2fa-reset-link.expires-warning', ['minutes' => $expiresInMinutes])
            </p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a
                href="{{ $resetUrl }}"
                style="display: inline-block; background-color: #dc3545; color: #ffffff; text-decoration: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 8px;"
            >
                @lang('twofactorauth::app.email.shop.2fa-reset-link.button')
            </a>
        </div>

        <p style="font-size: 14px; color: #6c757d; line-height: 20px;">
            @lang('twofactorauth::app.email.shop.2fa-reset-link.link-note')
        </p>

        <div style="background-color: #f8f9fa; padding: 10px; border-radius: 4px; margin: 15px 0; word-break: break-all;">
            <code style="font-size: 12px; color: #495057;">{{ $resetUrl }}</code>
        </div>

        <div style="background-color: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-weight: 600; color: #721c24;">
                @lang('twofactorauth::app.email.shop.2fa-reset-link.security-title')
            </p>
            <p style="margin: 10px 0 0 0; color: #721c24;">
                @lang('twofactorauth::app.email.shop.2fa-reset-link.security-message')
            </p>
        </div>

        <p style="font-size: 16px; color: #5E5E5E; line-height: 24px;">
            @lang('twofactorauth::app.email.shop.2fa-reset-link.closing')
        </p>
    </div>
@endcomponent
