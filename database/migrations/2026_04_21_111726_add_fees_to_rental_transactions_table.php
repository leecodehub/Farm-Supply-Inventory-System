<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_transactions', function (Blueprint $table) {
            $table->decimal('damage_fee', 10, 2)->default(0)->after('status');
            $table->decimal('total_amount_paid', 10, 2)->nullable()->after('damage_fee');
            $table->text('return_notes')->nullable()->after('total_amount_paid');
        });
    }

    public function down(): void
    {
        Schema::table('rental_transactions', function (Blueprint $table) {
            $table->dropColumn(['damage_fee', 'total_amount_paid', 'return_notes']);
        });
    }
};