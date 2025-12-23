# Two-Factor Authentication for Bagisto

## 🎯 Overview

A complete two-factor authentication (2FA) package for Bagisto that provides additional security for both the **Admin Panel** and the **Shop (Customers)**. Compatible with Google Authenticator, Microsoft Authenticator, Authy, and other TOTP applications.

---

## 📋 Main Features

### 1. Two-Factor Authentication (2FA)

| Feature | Admin | Shop |
|---------|:-----:|:----:|
| TOTP app integration (Google Authenticator, Authy, etc.) | ✅ | ✅ |
| QR code generation for easy setup | ✅ | ✅ |
| Manual secret entry as alternative | ✅ | ✅ |
| 6-digit OTP code verification | ✅ | ✅ |
| Time-based code expiration (configurable) | ✅ | ✅ |

### 2. Recovery Codes

| Feature | Admin | Shop |
|---------|:-----:|:----:|
| Automatic generation of 8 unique backup codes | ✅ | ✅ |
| 10-character uppercase codes | ✅ | ✅ |
| Secure storage with hash (bcrypt) | ✅ | ✅ |
| Single use per code | ✅ | ✅ |
| Remaining codes counter | ✅ | ✅ |
| Auto-disable 2FA when last code is used | ✅ | ✅ |
| Print and copy codes functions | ✅ | ✅ |

### 3. 2FA Management

| Feature | Admin | Shop |
|---------|:-----:|:----:|
| Enable 2FA voluntarily | ✅ | ✅ |
| Disable 2FA (with password) | ✅ | ✅ |
| Mandatory 2FA (configurable) | ✅ | ❌ |
| Reset 2FA for other users | ✅ | ❌ |
| 2FA activity logs | ✅ | ❌ |

---

## 🔄 User Flows

### Admin - First Time Setup (Mandatory 2FA)
```
Login → Setup (QR) → Verify code → View recovery codes → Dashboard
```

### Admin - Login with 2FA Configured
```
Login (email/password) → Verify 2FA code → Dashboard
```

### Shop (Customer) - Voluntary Activation
```
My Account → Security → Enable 2FA → Scan QR → Verify code → View recovery codes
```

### Shop (Customer) - Login with 2FA Enabled
```
Login (email/password) → 2FA verification page → Verify code → Home
```

### Recovery (Admin and Shop)
```
Verification page → "Lost your device?" → Enter recovery code → Access granted
```

---

## 🛡️ Security

### Security Features

| Feature | Description |
|---------|-------------|
| **Encryption** | 2FA secrets encrypted in database with `encrypt()` |
| **Code hashing** | Recovery codes hashed with bcrypt (irreversible) |
| **Protection middleware** | Blocks access until 2FA is verified |
| **QR expiration** | QR codes expire after configurable time |
| **Session regeneration** | Session regenerated after successful login |
| **Automatic cleanup** | Sensitive data removed from session after use |

### Middleware

| Middleware | Group | Function |
|------------|-------|----------|
| `Require2FA` | `admin` | Protects admin routes, forces setup if mandatory |
| `ShopRequire2FA` | `web` | Blocks customer navigation until 2FA is verified |

---

## 📧 Email System

### Available Notifications

| Email | Trigger | Recipient |
|-------|---------|-----------|
| `TwoFactorEnabledNotification` | Admin enables 2FA | Admin |
| `TwoFactorResetNotification` | Admin resets another user's 2FA | Affected user |

### Information Included in Emails

- Date and time of event
- IP address
- Device/User Agent
- Name of admin who performed the action (on reset)
- Security instructions

---

## 🎨 User Interface

### UI/UX Features

| Feature | Admin | Shop |
|---------|:-----:|:----:|
| Consistent design with Bagisto | ✅ | ✅ |
| Responsive (mobile/desktop) | ✅ | ✅ |
| Flash notifications | ✅ | ✅ |
| Copy codes to clipboard | ✅ | ✅ |
| Print recovery codes | ✅ | ✅ |

### Shop Pages

| Page | Route | Description |
|------|-------|-------------|
| Security | `/customer/account/security` | Main 2FA panel |
| Enable 2FA | `/customer/account/security/2fa/enable` | QR setup |
| Verify (Login) | `/customer/2fa/verify` | Login verification |
| Recovery | `/customer/2fa/recovery` | Use recovery code |

### Admin Pages

| Page | Route | Description |
|------|-------|-------------|
| Setup | `/admin/2fa/setup` | Initial QR setup |
| Verify | `/admin/2fa/verify` | Login verification |
| Recovery | `/admin/2fa/recovery` | Use recovery code |
| Logs | `/admin/2fa/logs/{id}` | View activity logs by user |

---

## 🌍 Internationalization (i18n)

### Supported Languages

| Language | Code | Status |
|----------|------|--------|
| English | `en` | ✅ Complete |
| Spanish | `es` | ✅ Complete |

### Translation Files

```
Resources/lang/
├── en/
│   └── app.php
└── es/
    └── app.php
```

All text strings are translated including:
- Interface messages
- Errors and validations
- Flash notifications
- Email content

---

## 🗄️ Database

### Migrations

| Migration | Table | Columns |
|-----------|-------|---------|
| `add_2fa_columns_to_admins_table` | `admins` | `google2fa_secret`, `google2fa_enabled_at` |
| `add_recovery_codes_to_admins_table` | `admins` | `two_factor_recovery_codes` |
| `add_2fa_columns_to_customers_table` | `customers` | `google2fa_secret`, `google2fa_enabled_at` |
| `add_recovery_codes_to_customers_table` | `customers` | `two_factor_recovery_codes` |
| `create_two_factor_logs_table` | `two_factor_logs` | 2FA activity logs |

### TwoFactorLog Model

| Field | Type | Description |
|-------|------|-------------|
| `admin_id` | integer | Affected user |
| `action` | string | Action type (enabled, verified, reset, etc.) |
| `performed_by` | integer | Admin who performed the action |
| `ip_address` | string | Request IP |
| `user_agent` | string | Browser user agent |

---

## 📁 Package Structure

```
Encodyn/TwoFactorAuth/
├── Config/
│   ├── menu.php
│   └── twofactorauth.php
├── Console/Commands/
│   └── Reset2FA.php
├── Database/Migrations/
│   ├── add_2fa_columns_to_admins_table.php
│   ├── add_recovery_codes_to_admins_table.php
│   ├── add_2fa_columns_to_customers_table.php
│   ├── add_recovery_codes_to_customers_table.php
│   └── create_two_factor_logs_table.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── TwoFactorAuthController.php
│   │   └── Shop/
│   │       └── TwoFactorAuthController.php
│   └── Middleware/
│       ├── Require2FA.php
│       └── ShopRequire2FA.php
├── Listeners/
│   ├── AdminLoginListener.php
│   └── CustomerLoginListener.php
├── Mail/Admin/
│   ├── TwoFactorEnabledNotification.php
│   └── TwoFactorResetNotification.php
├── Models/
│   └── TwoFactorLog.php
├── Providers/
│   └── TwoFactorAuthServiceProvider.php
├── Resources/
│   ├── lang/
│   │   ├── en/
│   │   │   └── app.php
│   │   └── es/
│   │       └── app.php
│   └── views/
│       ├── admin/
│       │   ├── 2fa/
│       │   │   ├── setup.blade.php
│       │   │   ├── verify.blade.php
│       │   │   ├── recovery.blade.php
│       │   │   ├── recovery-codes.blade.php
│       │   │   └── logs.blade.php
│       │   └── settings/users/
│       │       └── index.blade.php
│       ├── emails/admin/
│       │   ├── 2fa-enabled.blade.php
│       │   └── 2fa-reset.blade.php
│       └── shop/customers/account/security/
│           ├── index.blade.php
│           ├── enable.blade.php
│           ├── verify.blade.php
│           ├── recovery.blade.php
│           └── recovery-codes.blade.php
├── Routes/
│   ├── admin-routes.php
│   ├── shop-routes.php
│   └── breadcrumbs.php
└── Traits/
    └── LogsTwoFactorActivity.php
```

---

## ⚙️ Configuration

### Configuration File

```php
// Config/twofactorauth.php

return [
    // QR code expiration time in minutes
    'qr_code_expiration' => 10,
    
    // Mandatory 2FA for admins
    'admin_required' => true,
    
    // Other configurations...
];
```

### Menu Registration (Shop)

```php
// Config/menu.php

$menus = config('menu.customer', []);
$lastSort = collect($menus)->max('sort') ?? 0;

return [
    [
        'key'   => 'account.security',
        'name'  => 'twofactorauth::app.shop.security.menu',
        'route' => 'shop.customer.account.security.index',
        'icon'  => 'icon-gdpr-safe',
        'sort'  => $lastSort + 1,
    ],
];
```

---

## 🚀 Installation

### 1. Add the package

```bash
composer require encodyn/twofactorauth
```

### 2. Run migrations

```bash
php artisan migrate
```

### 3. Clear cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## 🔧 Artisan Commands

### Reset 2FA for a admin

```bash
# Reset 2FA for an admin by email
php artisan 2fa:reset example@email.com

```

---

## 📊 Feature Summary

### Admin Panel

| Feature | Status |
|---------|--------|
| Configure 2FA with QR | ✅ |
| Verify code on login | ✅ |
| Use recovery codes | ✅ |
| Mandatory 2FA (configurable) | ✅ |
| Reset 2FA for other users | ✅ |
| View 2FA activity logs | ✅ |
| Email notifications | ✅ |

### Shop (Customer)

| Feature | Status |
|---------|--------|
| Enable 2FA voluntarily | ✅ |
| Disable 2FA (with password) | ✅ |
| Verify code on login | ✅ |
| Use recovery codes | ✅ |
| Auto-disable when codes exhausted | ✅ |
| Flash notifications | ✅ |
| Security menu in account | ✅ |
| UI consistent with Bagisto | ✅ |

---

## 📝 Important Notes

1. **Independence**: The package does not modify Bagisto core
2. **Events**: Uses Laravel events to intercept login
3. **Middleware**: Automatically registered in corresponding groups
4. **Rollback**: All migrations are reversible
5. **Compatibility**: Designed for Bagisto 2.x

---

## 📄 License

MIT

---

## 👨‍💻 Author

**Encodyn**

---

## 🤝 Contributions

Contributions are welcome. Please open an issue or pull request.
