<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {

            if (!Schema::hasColumn('quotes', 'city')) {
                $table->string('city')->after('address')->nullable();
            }

            if (!Schema::hasColumn('quotes', 'postal_code')) {
                $table->string('postal_code')->after('city')->nullable();
            }

            if (!Schema::hasColumn('quotes', 'urgency')) {
                $table->enum('urgency', ['low', 'normal', 'high'])->default('normal')->after('preferred_date');
            }

            if (!Schema::hasColumn('quotes', 'images')) {
                $table->json('images')->nullable()->after('message');
            }

            if (!Schema::hasColumn('quotes', 'assigned_to')) {
                $table->foreignId('assigned_to')->nullable()->after('status')->constrained('users')->onDelete('set null');
            }

            if (!Schema::hasColumn('quotes', 'quoted_price')) {
                $table->decimal('quoted_price', 10, 2)->nullable()->after('admin_notes');
            }

            if (!Schema::hasColumn('quotes', 'quote_details')) {
                $table->text('quote_details')->nullable()->after('quoted_price');
            }

            if (!Schema::hasColumn('quotes', 'quote_valid_until')) {
                $table->date('quote_valid_until')->nullable()->after('quote_details');
            }
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $columns = ['city', 'postal_code', 'urgency', 'images', 'assigned_to', 'quoted_price', 'quote_details', 'quote_valid_until'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('quotes', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
