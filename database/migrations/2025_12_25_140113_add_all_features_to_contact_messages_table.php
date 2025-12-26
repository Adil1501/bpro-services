<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }

            if (!Schema::hasColumn('contact_messages', 'status')) {
                $table->enum('status', ['new', 'read', 'archived'])->default('new')->after('message');
            }

            if (!Schema::hasColumn('contact_messages', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }

            if (!Schema::hasColumn('contact_messages', 'replied_by')) {
                $table->foreignId('replied_by')->nullable()->after('admin_notes')->constrained('users')->onDelete('set null');
            }

            if (!Schema::hasColumn('contact_messages', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('replied_by');
            }

            if (!Schema::hasColumn('contact_messages', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('replied_at');
            }

            if (!Schema::hasColumn('contact_messages', 'user_agent')) {
                $table->string('user_agent')->nullable()->after('ip_address');
            }
        });

        DB::statement("UPDATE contact_messages SET status = 'read' WHERE is_read = 1 AND status = 'new'");
        DB::statement("UPDATE contact_messages SET status = 'new' WHERE is_read = 0 AND status = 'read'");
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'status',
                'admin_notes',
                'replied_by',
                'replied_at',
                'ip_address',
                'user_agent'
            ]);
        });
    }
};
