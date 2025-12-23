<?php

namespace Encodyn\TwoFactorAuth\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\Admin;

class TwoFactorLog extends Model
{
    public $timestamps = false;

    protected $table = 'admin_2fa_logs';

    protected $fillable = [
        'admin_id',
        'action',
        'ip_address',
        'user_agent',
        'performed_by',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function performedBy()
    {
        return $this->belongsTo(Admin::class, 'performed_by');
    }

    public static function log(string $action, int $adminId, ?int $performedBy = null): void
    {
        self::create([
            'admin_id'     => $adminId,
            'action'       => $action,
            'ip_address'   => request()->ip(),
            'user_agent'   => request()->userAgent(),
            'performed_by' => $performedBy,
            'created_at'   => now(),
        ]);
    }
}
