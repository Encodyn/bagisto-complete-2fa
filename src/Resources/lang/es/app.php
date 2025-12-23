<?php

return [
    // Configuración
    'setup-title'       => 'Configurar Autenticación de Dos Factores',
    'scan-qr'           => 'Escanea este código QR con tu aplicación de autenticación (Google Authenticator, Authy, etc.)',
    'manual-entry'      => 'O ingresa este código manualmente:',
    'verification-code' => 'Código de Verificación',
    'enter-code'        => 'Ingresar código',
    'enable-2fa'        => 'Activar 2FA',

    // Verificar
    'verify-title'       => 'Autenticación de Dos Factores',
    'enter-verification' => 'Ingresa el código de 6 dígitos de tu aplicación de autenticación',
    'verify'             => 'Verificar',
    'return-login'       => 'Volver al inicio de sesión',

    // Códigos de Recuperación
    'recovery-codes-title' => 'Códigos de Recuperación',
    '2fa-success'          => '¡2FA Configurado Exitosamente!',
    'save-codes-message'   => 'Guarda estos códigos de recuperación en un lugar seguro. Si pierdes tu teléfono, estos códigos son la única forma de acceder a tu cuenta.',
    'codes-warning'        => 'Importante: Cada código solo puede usarse una vez. Guárdalos en un lugar seguro.',
    'print-codes'          => 'Imprimir códigos',
    'copy-codes'           => 'Copiar al portapapeles',
    'continue-dashboard'   => 'He guardado los códigos, continuar →',
    'copied'               => 'Copiado',
    'copy-error'           => 'Error al copiar',

    // Recuperación
    'recovery-title'   => 'Recuperación de Cuenta',
    'recovery-message' => 'Ingresa uno de tus códigos de respaldo de 10 caracteres.',
    'lost-device'      => '¿Perdiste tu dispositivo?',
    'back-to-2fa'      => 'Volver a 2FA',
    'verify-recovery'  => 'Verificar',

    // Errores
    'session-expired'       => 'Sesión expirada. Por favor, intenta de nuevo.',
    'qr-expired'            => 'Código QR expirado. Por favor, genera uno nuevo.',
    'invalid-code'          => 'Código de verificación inválido.',
    'invalid-user'          => 'Usuario inválido.',
    'account-deactivated'   => 'Tu cuenta ha sido desactivada.',
    'reset-success'         => '2FA se ha restablecido exitosamente.',
    'invalid-recovery-code' => 'Código inválido o ya usado.',
    'no-recovery-codes'     => 'No hay códigos de recuperación disponibles.',

    // Mensajes flash
    'recovery-code-accepted'  => 'Código aceptado. Te quedan :count códigos de respaldo.',
    'last-recovery-code-used' => 'Has usado tu último código de respaldo. Por razones de seguridad, debes configurar tu 2FA nuevamente.',

    // Modal de restablecimiento de administrador
    'reset-2fa-title' => 'Restablecer Autenticación de Dos Factores',
    'confirm-reset'   => '¿Estás seguro de que quieres restablecer 2FA para este usuario?',
    'reset-warning'   => 'El usuario deberá configurar 2FA nuevamente en su próximo inicio de sesión.',
    'cancel'          => 'Cancelar',
    'confirm'         => 'Restablecer 2FA',

    'admin' => [
        '2fa' => [
            'logs' => [
                'title'        => 'Registro de Actividad 2FA para :name',
                'back'         => 'Volver a Usuarios',
                'date'         => 'Fecha y Hora',
                'action'       => 'Acción',
                'ip'           => 'Dirección IP',
                'performed_by' => 'Realizado Por',
                'no_logs'      => 'No se encontraron registros de actividad para este usuario',
                'self'         => 'Mismo',

                'actions' => [
                    'enabled'        => 'Activado',
                    'verified'       => 'Verificado',
                    'recovery_used'  => 'Código de Recuperación Usado',
                    'reset_by_admin' => 'Restablecido por Administrador',
                    'reset_self'     => 'Restablecimiento Propio',
                    'failed_attempt' => 'Intento Fallido',
                    'cli_reset'      => 'Restablecimiento CLI',
                ],
            ],
        ],
    ],

    'shop' => [
        'security' => [
            'account' => 'Mi Cuenta',
            'menu'    => 'Seguridad',
            'title'   => 'Seguridad',

            '2fa-enabled'              => 'Autenticación de Dos Factores Activada',
            '2fa-enabled-description'  => 'Tu cuenta está protegida con 2FA',
            '2fa-disabled'             => 'Autenticación de Dos Factores Desactivada',
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
            'copy-failed'         => 'Error al copiar. Por favor, copia manualmente.',

            'verify-code-title'           => 'Paso 2: Verificar Código',
            'verify-code-description'     => 'Ingresa el código de 6 dígitos de tu aplicación de autenticación para verificar la configuración.',
            'verification-code'           => 'Código de Verificación',
            'enter-code'                  => '000000',
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

            'last-recovery-used'    => 'Ese fue tu último código de recuperación. La autenticación de dos factores ha sido desactivada. Por favor, configúrala nuevamente.',
            'recovery-used'         => 'Código de recuperación aceptado. Te quedan :count códigos.',
            'invalid-recovery-code' => 'Código de recuperación inválido.',
            'no-recovery-codes'     => 'No se encontraron códigos de recuperación para esta cuenta.',

            'confirm-disable'             => 'Desactivar Autenticación de Dos Factores',
            'confirm-disable-message'     => '¿Estás seguro de que quieres desactivar la autenticación de dos factores? Esto hará tu cuenta menos segura.',
            'password'                    => 'Contraseña',
            'confirm'                     => 'Confirmar',
            'use-recovery-code'           => 'Usar un código de recuperación',
            'have-authenticator'          => '¿Tienes tu autenticador?',
            'or'                          => 'o',
            'reset-via-email'             => 'Restablecer por Email',
            'reset-via-email-description' => '¿Perdiste tus códigos de recuperación también? Podemos enviarte un enlace de restablecimiento a tu dirección de correo registrada.',
            'send-reset-link'             => 'Enviar Enlace de Restablecimiento a Mi Email',

        ],
    ],

    // Correos Electrónicos
    'email' => [
        '2fa-enabled' => [
            'subject'         => 'Autenticación de Dos Factores Activada',
            'greeting'        => 'Hola :name,',
            'message'         => 'La autenticación de dos factores (2FA) ha sido activada exitosamente en tu cuenta.',
            'success-title'   => 'Tu cuenta ahora es más segura',
            'enabled-at'      => 'Activado el',
            'ip-address'      => 'Dirección IP',
            'device'          => 'Dispositivo',
            'warning-title'   => 'Importante',
            'warning-message' => 'Si no activaste 2FA, por favor contacta a soporte inmediatamente.',
            'backup-codes'    => 'Asegúrate de haber guardado tus códigos de recuperación de respaldo en un lugar seguro. Los necesitarás si pierdes acceso a tu dispositivo de autenticación.',
            'closing'         => 'Gracias por mantener tu cuenta segura.',
        ],
        '2fa-reset' => [
            'subject'         => 'Tu Autenticación de Dos Factores Ha Sido Restablecida',
            'greeting'        => 'Hola :name,',
            'alert-title'     => 'Tu 2FA ha sido restablecido',
            'alert-message'   => 'Tu autenticación de dos factores ha sido restablecida por un administrador.',
            'reset-by'        => 'Restablecido por',
            'reset-at'        => 'Restablecido el',
            'next-steps'      => 'En tu próximo inicio de sesión, necesitarás configurar 2FA nuevamente:',
            'info-title'      => 'Próximos pasos',
            'step-1'          => 'Inicia sesión con tu email y contraseña',
            'step-2'          => 'Escanea el código QR con tu aplicación de autenticación',
            'step-3'          => 'Guarda tus nuevos códigos de respaldo',
            'warning-title'   => 'Importante',
            'warning-message' => 'Si no solicitaste este restablecimiento, por favor contacta a soporte inmediatamente y cambia tu contraseña.',
            'closing'         => 'Si tienes alguna pregunta, por favor contacta a nuestro equipo de soporte.',
        ],

        'shop' => [
            '2fa-enabled' => [
                'subject'         => 'Autenticación de Dos Factores Activada',
                'greeting'        => 'Hola :name,',
                'message'         => 'La autenticación de dos factores ha sido activada exitosamente en tu cuenta.',
                'success-title'   => 'Tu cuenta ahora está protegida con 2FA',
                'enabled-at'      => 'Activado el',
                'ip-address'      => 'Dirección IP',
                'device'          => 'Dispositivo',
                'warning-title'   => 'Importante',
                'warning-message' => 'Si no activaste 2FA, por favor contacta a soporte inmediatamente y cambia tu contraseña.',
                'backup-codes'    => 'Asegúrate de guardar tus códigos de recuperación en un lugar seguro. Los necesitarás si pierdes acceso a tu aplicación de autenticación.',
                'closing'         => 'Gracias por mantener tu cuenta segura.',
            ],

            '2fa-reset-link' => [
                'subject'          => 'Restablecer Autenticación de Dos Factores',
                'greeting'         => 'Hola :name,',
                'message'          => 'Recibimos una solicitud para desactivar la autenticación de dos factores en tu cuenta. Haz clic en el botón de abajo para continuar.',
                'expires-warning'  => 'Este enlace expirará en :minutes minutos.',
                'button'           => 'Desactivar Autenticación de Dos Factores',
                'link-note'        => 'Si el botón no funciona, copia y pega este enlace en tu navegador:',
                'security-title'   => 'Advertencia de Seguridad',
                'security-message' => 'Si no solicitaste esto, por favor ignora este correo. Tu 2FA permanecerá activado y tu cuenta está segura.',
                'closing'          => 'Si tienes alguna pregunta, por favor contacta a nuestro equipo de soporte.',
            ],

            'reset-link-sent'    => 'Se ha enviado un enlace de restablecimiento a tu dirección de correo electrónico.',
            'reset-link-expired' => 'Este enlace de restablecimiento ha expirado. Por favor, solicita uno nuevo.',
            'reset-link-invalid' => 'Este enlace de restablecimiento es inválido.',
            '2fa-reset-success'  => 'La autenticación de dos factores ha sido desactivada. Puedes activarla nuevamente en cualquier momento.',
        ],

    ],
];