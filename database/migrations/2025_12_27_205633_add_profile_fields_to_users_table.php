<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->date('birthday')->nullable()->after('email');
            $table->string('profile_photo')->nullable()->after('birthday');
            $table->text('bio')->nullable()->after('profile_photo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'birthday', 'profile_photo', 'bio']);
        });
    }
};
