<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_transactions', function (Blueprint $table) {
            $table->id();
            
            // The links to the Asset and the Customer
            $table->foreignId('rental_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            
            // The transaction details
            $table->date('start_date');
            $table->date('expected_return_date');
            $table->date('actual_return_date')->nullable();
            $table->string('status')->default('Active'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_transactions');
    }
};