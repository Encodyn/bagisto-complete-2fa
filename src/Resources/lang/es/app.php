<?php

return [
    // Setup
    'setup-title'       => 'Configurar Autenticación de Dos Factores',
    'scan-qr'           => 'Escanea este código QR con tu aplicación de autenticación (Google Authenticator, Authy, etc.)',
    'manual-entry'      => 'O ingresa este código manualmente:',
    'verification-code' => 'Código de Verificación',
    'enter-code'        => 'Ingresa el código',
    'enable-2fa'        => 'Activar 2FA',

    // Verify
    'verify-title'       => 'Autenticación de Dos Factores',
    'enter-verification' => 'Ingresa el código de 6 dígitos de tu aplicación de autenticación',
    'verify'             => 'Verificar',
    'return-login'       => 'Volver al inicio de sesión',

    // Recovery Codes
    'recovery-codes-title' => 'Códigos de Recuperación',
    '2fa-success'          => '¡2FA Configurado Exitosamente!',
    'save-codes-message'   => 'Guarda estos códigos de recuperación en un lugar seguro. Si pierdes tu teléfono, estos códigos son la única forma de acceder a tu cuenta.',
    'codes-warning'        => 'Importante: Cada código solo se puede usar una vez. Guárdalos en un lugar seguro.',
    'print-codes'          => 'Imprimir códigos',
    'copy-codes'           => 'Copiar al portapapeles',
    'continue-dashboard'   => 'He guardado los códigos, continuar →',
    'copied'               => 'Copiado',
    'copy-error'           => 'Error al copiar',

    // Recovery
    'recovery-title'   => 'Recuperación de Cuenta',
    'recovery-message' => 'Ingresa uno de tus códigos de respaldo de 10 caracteres.',
    'lost-device'      => '¿Perdiste tu dispositivo?',
    'back-to-2fa'      => 'Volver al 2FA',
    'verify-recovery'  => 'Verificar',

    // Errors
    'session-expired'       => 'Sesión expirada. Por favor, intenta de nuevo.',
    'qr-expired'            => 'Código QR expirado. Por favor, genera uno nuevo.',
    'invalid-code'          => 'Código de verificación inválido.',
    'invalid-user'          => 'Usuario inválido.',
    'account-deactivated'   => 'Tu cuenta ha sido desactivada.',
    'reset-success'         => 'El 2FA ha sido restablecido exitosamente.',
    'invalid-recovery-code' => 'Código inválido o ya utilizado.',
    'no-recovery-codes'     => 'No hay códigos de recuperación disponibles.',

    // Flash messages
    'recovery-code-accepted'  => 'Código aceptado. Te quedan :count códigos de respaldo.',
    'last-recovery-code-used' => 'Has usado tu último código de respaldo. Por seguridad, debes configurar tu 2FA nuevamente.',

    // Admin reset modal
    'reset-2fa-title' => 'Restablecer Autenticación de Dos Factores',
    'confirm-reset'   => '¿Estás seguro de que deseas restablecer la 2FA de este usuario?',
    'reset-warning'   => 'El usuario deberá configurar la 2FA nuevamente en su próximo inicio de sesión.',
    'cancel'          => 'Cancelar',
    'confirm'         => 'Restablecer 2FA',

    'email' => [
        '2fa-enabled' => [
            'subject'         => 'Autenticación de Dos Factores Activada',
            'greeting'        => 'Hola :name,',
            'message'         => 'La autenticación de dos factores (2FA) ha sido habilitada exitosamente en tu cuenta.',
            'success-title'   => 'Tu cuenta ahora es más segura',
            'enabled-at'      => 'Habilitada el',
            'ip-address'      => 'Dirección IP',
            'device'          => 'Dispositivo',
            'warning-title'   => 'Importante',
            'warning-message' => 'Si no habilitaste la 2FA, por favor contacta a soporte inmediatamente.',
            'backup-codes'    => 'Asegúrate de haber guardado tus códigos de recuperación en un lugar seguro. Los necesitarás si pierdes acceso a tu dispositivo de autenticación.',
            'closing'         => 'Gracias por mantener tu cuenta segura.',
        ],
        '2fa-reset' => [
            'subject'         => 'Tu Autenticación de Dos Factores Ha Sido Restablecida',
            'greeting'        => 'Hola :name,',
            'alert-title'     => 'Tu 2FA ha sido restablecida',
            'alert-message'   => 'Tu autenticación de dos factores ha sido restablecida por un administrador.',
            'reset-by'        => 'Restablecida por',
            'reset-at'        => 'Restablecida el',
            'next-steps'      => 'En tu próximo inicio de sesión, deberás configurar la 2FA nuevamente:',
            'info-title'      => 'Próximos pasos',
            'step-1'          => 'Inicia sesión con tu email y contraseña',
            'step-2'          => 'Escanea el código QR con tu aplicación de autenticación',
            'step-3'          => 'Guarda tus nuevos códigos de respaldo',
            'warning-title'   => 'Importante',
            'warning-message' => 'Si no solicitaste este restablecimiento, por favor contacta a soporte inmediatamente y cambia tu contraseña.',
            'closing'         => 'Si tienes alguna pregunta, por favor contacta a nuestro equipo de soporte.',
        ],
    ],

    'admin' => [
        '2fa' => [
            'logs' => [
                'title'        => 'Registro de actividad 2FA de :name',
                'back'         => 'Volver a usuarios',
                'date'         => 'Fecha y hora',
                'action'       => 'Acción',
                'ip'           => 'Dirección IP',
                'performed_by' => 'Realizado por',
                'no_logs'      => 'No se encontraron registros de actividad para este usuario',
                'self'         => 'Propio',

                'actions' => [
                    'enabled'        => 'Habilitado',
                    'verified'       => 'Verificado',
                    'recovery_used'  => 'Código de recuperación usado',
                    'reset_by_admin' => 'Restablecido por el administrador',
                    'reset_self'     => 'Restablecimiento propio',
                    'failed_attempt' => 'Intento fallido',
                    'cli_reset'      => 'Restablecido por CLI',
                ],
            ],
        ],
    ],
    'shop' => [
        'security' => [
            'account' => 'Mi Cuenta',
            'menu'    => 'Seguridad',
            'title'   => 'Seguridad de la Cuenta',

            '2fa-enabled'              => 'La Autenticación de Dos Factores está Activada',
            '2fa-enabled-description'  => 'Tu cuenta está protegida con 2FA',
            '2fa-disabled'             => 'La Autenticación de Dos Factores está Desactivada',
            '2fa-disabled-description' => 'Activa 2FA para añadir una capa extra de seguridad a tu cuenta',

            'enabled-at'          => 'Activado el',
            'enable-2fa'          => 'Activar Autenticación de Dos Factores',
            'disable-2fa'         => 'Desactivar 2FA',
            'view-recovery-codes' => 'Ver Códigos de Recuperación',
            'enter-password'      => 'Ingresa tu contraseña para desactivar 2FA:',

            'what-is-2fa'     => '¿Qué es la Autenticación de Dos Factores?',
            '2fa-description' => 'La autenticación de dos factores añade una capa extra de seguridad a tu cuenta al requerir más que solo una contraseña para iniciar sesión. Necesitarás ingresar un código de tu aplicación de autenticación al iniciar sesión.',

            'invalid-password'     => 'La contraseña que ingresaste es incorrecta.',
            '2fa-disabled-success' => 'La autenticación de dos factores ha sido desactivada.',
            'already-enabled'      => 'La autenticación de dos factores ya está activada para tu cuenta.',

            // Página de Activación
            'scan-qr'             => 'Escanear Código QR',
            'verify-code'         => 'Verificar Código',
            'scan-qr-title'       => 'Paso 1: Escanear Código QR',
            'scan-qr-description' => 'Usa una aplicación de autenticación como Google Authenticator, Authy o Microsoft Authenticator para escanear este código QR.',
            'manual-entry'        => 'O ingresa este código manualmente:',
            'copy'                => 'Copiar',
            'secret-copied'       => '¡Clave secreta copiada al portapapeles!',
            'copy-failed'         => 'Error al copiar. Por favor copia manualmente.',

            'verify-code-title'       => 'Paso 2: Verificar Código',
            'verify-code-description' => 'Ingresa el código de 6 dígitos de tu aplicación de autenticación para verificar la configuración.',
            'verification-code'       => 'Código de Verificación',
            'enter-code'              => '000000',

            'important-notice'            => 'Aviso Importante',
            'save-recovery-codes-warning' => 'Después de activar 2FA, recibirás códigos de recuperación. Guárdalos en un lugar seguro - los necesitarás si pierdes acceso a tu aplicación de autenticación.',
            'enable-2fa-button'           => 'Activar 2FA',

            'cancel'             => 'Cancelar',
            'verify-title'       => 'Autenticación de Dos Factores',
            'verify-description' => 'Ingresa el código de 6 dígitos de tu aplicación de autenticación.',
            'verify-button'      => 'Verificar',
            'lost-device'        => '¿Perdiste tu dispositivo?',

            'recovery-title'       => 'Recuperación de Cuenta',
            'recovery-description' => 'Ingresa uno de tus códigos de recuperación para acceder a tu cuenta.',
            'recovery-code'        => 'Código de Recuperación',
            'back-to-verify'       => 'Volver a verificación',

            'recovery-codes-title'            => 'Códigos de Recuperación',
            '2fa-enabled-success'             => '¡Autenticación de Dos Factores Activada!',
            '2fa-enabled-success-description' => 'Tu cuenta ahora está protegida con una capa extra de seguridad.',
            'save-codes-warning'              => 'Guarda Estos Códigos de Recuperación',
            'codes-warning-description'       => 'Guárdalos en un lugar seguro. Los necesitarás si pierdes acceso a tu aplicación de autenticación.',
            'your-recovery-codes'             => 'Tus Códigos de Recuperación',
            'print-codes'                     => 'Imprimir Códigos',
            'copy-codes'                      => 'Copiar Códigos',
            'continue-to-account'             => 'Continuar a Mi Cuenta',
            'codes-copied'                    => '¡Códigos de recuperación copiados al portapapeles!',

            'last-recovery-used'    => 'Ese fue tu último código de recuperación. La autenticación de dos factores ha sido desactivada. Por favor configúrala de nuevo.',
            'recovery-used'         => 'Código de recuperación aceptado. Te quedan :count códigos.',
            'invalid-recovery-code' => 'Código de recuperación inválido.',
            'no-recovery-codes'     => 'No se encontraron códigos de recuperación para esta cuenta.',

            // Modal Desactivar 2FA
            'confirm-disable'         => 'Desactivar Autenticación de Dos Factores',
            'confirm-disable-message' => '¿Estás seguro de que deseas desactivar la autenticación de dos factores? Esto hará tu cuenta menos segura.',
            'password'                => 'Contraseña',
            'confirm'                 => 'Confirmar',
            'use-recovery-code'       => 'Usar un código de recuperación',
            'have-authenticator'      => '¿Tienes tu autenticador?',
        ],
    ],

];
