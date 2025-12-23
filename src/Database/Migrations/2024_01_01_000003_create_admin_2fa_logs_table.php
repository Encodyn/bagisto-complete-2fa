<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_2fa_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('admin_id');

            $table->enum('action', [
                'enabled',
                'verified',
                'recovery_used',
                'reset_by_admin',
                'reset_self',
                'failed_attempt',
                'cli_reset',
            ]);

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->unsignedInteger('performed_by')->nullable()
                ->comment('ID of the administrator who performed the action');

            $table->timestamps();

            $table->index(['admin_id', 'created_at']);
            $table->index('action');

            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_2fa_logs');
    }
};
