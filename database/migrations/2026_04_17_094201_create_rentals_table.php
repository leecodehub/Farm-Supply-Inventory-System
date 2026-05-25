<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sn')->unique(); // Serial Number
            $table->string('category');
            $table->decimal('daily_rate', 10, 2);
            $table->string('status')->default('Available');
            $table->string('image')->nullable(); // <-- NEW: Added image column
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};