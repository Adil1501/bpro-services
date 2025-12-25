<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('company_name')->nullable();
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->integer('surface_area')->nullable();
            $table->date('preferred_date')->nullable();
            $table->enum('urgency', ['low', 'normal', 'high'])->default('normal');
            $table->json('images')->nullable();
            $table->enum('status', ['new', 'in_progress', 'quoted', 'accepted', 'rejected', 'completed'])
                  ->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->text('admin_notes')->nullable();
            $table->decimal('quoted_price', 10, 2)->nullable();
            $table->text('quote_details')->nullable();
            $table->date('quote_valid_until')->nullable();
            $table->timestamps();
            $table->index(['status', 'created_at']);
            $table->index('customer_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
