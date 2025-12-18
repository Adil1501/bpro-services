<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('portfolio_project_id');
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('portfolio_project_id')
                  ->references('id')
                  ->on('portfolio_projects')
                  ->onDelete('cascade');
            $table->unique(['user_id', 'portfolio_project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_likes');
    }
};
