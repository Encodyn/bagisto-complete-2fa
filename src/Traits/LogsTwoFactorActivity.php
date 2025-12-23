<?php

namespace Encodyn\TwoFactorAuth\Traits;

use Encodyn\TwoFactorAuth\Models\TwoFactorLog;

trait LogsTwoFactorActivity
{
    protected function log2FAActivity(string $action, int $adminId, ?int $performedBy = null): void
    {
        TwoFactorLog::log($action, $adminId, $performedBy);
    }
}
