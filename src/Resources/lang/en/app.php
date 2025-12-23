<?php

return [
    // Setup
    'setup-title'       => 'Set Up Two-Factor Authentication',
    'scan-qr'           => 'Scan this QR code with your authenticator app (Google Authenticator, Authy, etc.)',
    'manual-entry'      => 'Or enter this code manually:',
    'verification-code' => 'Verification Code',
    'enter-code'        => 'Enter code',
    'enable-2fa'        => 'Enable 2FA',

    // Verify
    'verify-title'       => 'Two-Factor Authentication',
    'enter-verification' => 'Enter the 6-digit code from your authenticator app',
    'verify'             => 'Verify',
    'return-login'       => 'Return to login',

    // Recovery Codes
    'recovery-codes-title' => 'Recovery Codes',
    '2fa-success'          => '2FA Configured Successfully!',
    'save-codes-message'   => 'Save these recovery codes in a safe place. If you lose your phone, these codes are the only way to access your account.',
    'codes-warning'        => 'Important: Each code can only be used once. Keep them in a secure location.',
    'print-codes'          => 'Print codes',
    'copy-codes'           => 'Copy to clipboard',
    'continue-dashboard'   => 'I have saved the codes, continue →',
    'copied'               => 'Copied',
    'copy-error'           => 'Copy error',

    // Recovery
    'recovery-title'   => 'Account Recovery',
    'recovery-message' => 'Enter one of your 10-character backup codes.',
    'lost-device'      => 'Lost your device?',
    'back-to-2fa'      => 'Back to 2FA',
    'verify-recovery'  => 'Verify',

    // Errors
    'session-expired'       => 'Session expired. Please try again.',
    'qr-expired'            => 'QR code expired. Please generate a new one.',
    'invalid-code'          => 'Invalid verification code.',
    'invalid-user'          => 'Invalid user.',
    'account-deactivated'   => 'Your account has been deactivated.',
    'reset-success'         => '2FA has been reset successfully.',
    'invalid-recovery-code' => 'Invalid or already used code.',
    'no-recovery-codes'     => 'No recovery codes available.',

    // Flash messages
    'recovery-code-accepted'  => 'Code accepted. You have :count backup codes remaining.',
    'last-recovery-code-used' => 'You have used your last backup code. For security reasons, you must set up your 2FA again.',

    // Admin reset modal
    'reset-2fa-title' => 'Reset Two-Factor Authentication',
    'confirm-reset'   => 'Are you sure you want to reset 2FA for this user?',
    'reset-warning'   => 'The user will need to set up 2FA again on their next login.',
    'cancel'          => 'Cancel',
    'confirm'         => 'Reset 2FA',

    'admin' => [
        '2fa' => [
            'logs' => [
                'title'        => '2FA Activity Log for :name',
                'back'         => 'Back to Users',
                'date'         => 'Date & Time',
                'action'       => 'Action',
                'ip'           => 'IP Address',
                'performed_by' => 'Performed By',
                'no_logs'      => 'No activity logs found for this user',
                'self'         => 'Self',

                'actions' => [
                    'enabled'        => 'Enabled',
                    'verified'       => 'Verified',
                    'recovery_used'  => 'Recovery Code Used',
                    'reset_by_admin' => 'Reset by Admin',
                    'reset_self'     => 'Self Reset',
                    'failed_attempt' => 'Failed Attempt',
                    'cli_reset'      => 'CLI Reset',
                ],
            ],
        ],
    ],

    'shop' => [
        'security' => [
            'account' => 'My Account',
            'menu'    => 'Security',
            'title'   => 'Security',

            '2fa-enabled'              => 'Two-Factor Authentication is Enabled',
            '2fa-enabled-description'  => 'Your account is protected with 2FA',
            '2fa-disabled'             => 'Two-Factor Authentication is Disabled',
            '2fa-disabled-description' => 'Enable 2FA to add an extra layer of security to your account',

            'enabled-at'          => 'Enabled on',
            'enable-2fa'          => 'Enable Two-Factor Authentication',
            'disable-2fa'         => 'Disable 2FA',
            'view-recovery-codes' => 'View Recovery Codes',
            'enter-password'      => 'Enter your password to disable 2FA:',

            'what-is-2fa'     => 'What is Two-Factor Authentication?',
            '2fa-description' => 'Two-factor authentication adds an extra layer of security to your account by requiring more than just a password to sign in. You\'ll need to enter a code from your authenticator app when signing in.',

            'invalid-password'     => 'The password you entered is incorrect.',
            '2fa-disabled-success' => 'Two-factor authentication has been disabled.',
            'already-enabled'      => 'Two-factor authentication is already enabled for your account.',

            // Enable Page
            'scan-qr'             => 'Scan QR Code',
            'verify-code'         => 'Verify Code',
            'scan-qr-title'       => 'Step 1: Scan QR Code',
            'scan-qr-description' => 'Use an authenticator app like Google Authenticator, Authy, or Microsoft Authenticator to scan this QR code.',
            'manual-entry'        => 'Or enter this code manually:',
            'copy'                => 'Copy',
            'secret-copied'       => 'Secret key copied to clipboard!',
            'copy-failed'         => 'Failed to copy. Please copy manually.',

            'verify-code-title'           => 'Step 2: Verify Code',
            'verify-code-description'     => 'Enter the 6-digit code from your authenticator app to verify the setup.',
            'verification-code'           => 'Verification Code',
            'enter-code'                  => '000000',
            'enable-2fa-button'           => 'Enable 2FA',

            'cancel'             => 'Cancel',
            'verify-title'       => 'Two-Factor Authentication',
            'verify-description' => 'Enter the 6-digit code from your authenticator app.',
            'verify-button'      => 'Verify',
            'lost-device'        => 'Lost your device?',

            'recovery-title'       => 'Account Recovery',
            'recovery-description' => 'Enter one of your recovery codes to access your account.',
            'recovery-code'        => 'Recovery Code',
            'back-to-verify'       => 'Back to verification',

            'recovery-codes-title'            => 'Recovery Codes',
            '2fa-enabled-success'             => 'Two-Factor Authentication Enabled!',
            '2fa-enabled-success-description' => 'Your account is now protected with an extra layer of security.',
            'save-codes-warning'              => 'Save These Recovery Codes',
            'codes-warning-description'       => 'Store them in a secure place. You\'ll need them if you lose access to your authenticator app.',
            'your-recovery-codes'             => 'Your Recovery Codes',
            'print-codes'                     => 'Print Codes',
            'copy-codes'                      => 'Copy Codes',
            'continue-to-account'             => 'Continue to My Account',
            'codes-copied'                    => 'Recovery codes copied to clipboard!',

            'last-recovery-used'    => 'That was your last recovery code. Two-factor authentication has been disabled. Please set it up again.',
            'recovery-used'         => 'Recovery code accepted. You have :count codes remaining.',
            'invalid-recovery-code' => 'Invalid recovery code.',
            'no-recovery-codes'     => 'No recovery codes found for this account.',

            'confirm-disable'             => 'Disable Two-Factor Authentication',
            'confirm-disable-message'     => 'Are you sure you want to disable two-factor authentication? This will make your account less secure.',
            'password'                    => 'Password',
            'confirm'                     => 'Confirm',
            'use-recovery-code'           => 'Use a recovery code',
            'have-authenticator'          => 'Have your authenticator?',
            'or'                          => 'or',
            'reset-via-email'             => 'Reset via Email',
            'reset-via-email-description' => 'Lost your recovery codes too? We can send a reset link to your registered email address.',
            'send-reset-link'             => 'Send Reset Link to My Email',

        ],
    ],

    // Emails
    'email' => [
        '2fa-enabled' => [
            'subject'         => 'Two-Factor Authentication Enabled',
            'greeting'        => 'Hello :name,',
            'message'         => 'Two-factor authentication (2FA) has been successfully enabled on your account.',
            'success-title'   => 'Your account is now more secure',
            'enabled-at'      => 'Enabled at',
            'ip-address'      => 'IP Address',
            'device'          => 'Device',
            'warning-title'   => 'Important',
            'warning-message' => 'If you did not enable 2FA, please contact support immediately.',
            'backup-codes'    => 'Make sure you have saved your backup recovery codes in a safe place. You will need them if you lose access to your authentication device.',
            'closing'         => 'Thank you for keeping your account secure.',
        ],
        '2fa-reset' => [
            'subject'         => 'Your Two-Factor Authentication Has Been Reset',
            'greeting'        => 'Hello :name,',
            'alert-title'     => 'Your 2FA has been reset',
            'alert-message'   => 'Your two-factor authentication has been reset by an administrator.',
            'reset-by'        => 'Reset by',
            'reset-at'        => 'Reset at',
            'next-steps'      => 'On your next login, you will need to set up 2FA again:',
            'info-title'      => 'Next steps',
            'step-1'          => 'Log in with your email and password',
            'step-2'          => 'Scan the QR code with your authenticator app',
            'step-3'          => 'Save your new backup codes',
            'warning-title'   => 'Important',
            'warning-message' => 'If you did not request this reset, please contact support immediately and change your password.',
            'closing'         => 'If you have any questions, please contact our support team.',
        ],

        'shop' => [
            '2fa-enabled' => [
                'subject'         => 'Two-Factor Authentication Enabled',
                'greeting'        => 'Hello :name,',
                'message'         => 'Two-factor authentication has been successfully enabled on your account.',
                'success-title'   => 'Your account is now protected with 2FA',
                'enabled-at'      => 'Enabled at',
                'ip-address'      => 'IP Address',
                'device'          => 'Device',
                'warning-title'   => 'Important',
                'warning-message' => 'If you did not enable 2FA, please contact support immediately and change your password.',
                'backup-codes'    => 'Make sure to save your recovery codes in a safe place. You will need them if you lose access to your authenticator app.',
                'closing'         => 'Thank you for keeping your account secure.',
            ],

            '2fa-reset-link' => [
                'subject'          => 'Reset Two-Factor Authentication',
                'greeting'         => 'Hello :name,',
                'message'          => 'We received a request to disable two-factor authentication on your account. Click the button below to proceed.',
                'expires-warning'  => 'This link will expire in :minutes minutes.',
                'button'           => 'Disable Two-Factor Authentication',
                'link-note'        => 'If the button doesn\'t work, copy and paste this link into your browser:',
                'security-title'   => 'Security Warning',
                'security-message' => 'If you did not request this, please ignore this email. Your 2FA will remain enabled and your account is safe.',
                'closing'          => 'If you have any questions, please contact our support team.',
            ],

            'reset-link-sent'    => 'A reset link has been sent to your email address.',
            'reset-link-expired' => 'This reset link has expired. Please request a new one.',
            'reset-link-invalid' => 'This reset link is invalid.',
            '2fa-reset-success'  => 'Two-factor authentication has been disabled. You can enable it again anytime.',
        ],

    ],
];
