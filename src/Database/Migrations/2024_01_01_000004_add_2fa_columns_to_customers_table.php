<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->text('google2fa_secret')->nullable()->after('password');
            $table->timestamp('google2fa_enabled_at')->nullable()->after('google2fa_secret');
            $table->text('two_factor_recovery_codes')->nullable()->after('google2fa_enabled_at');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['google2fa_secret', 'google2fa_enabled_at', 'two_factor_recovery_codes']);
        });
    }
};
