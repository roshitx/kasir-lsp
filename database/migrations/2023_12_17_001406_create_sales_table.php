<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('invoice')->unique();
            $table->string('customer');
            $table->string('kasir');
            $table->double('total_price');
            $table->enum('payment_method', ['Cash', 'QRIS', 'Transfer Bank', 'Credit Card', 'E-Wallet']);
            $table->dateTime('waktu')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
