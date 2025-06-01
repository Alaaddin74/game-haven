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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        // Kolom tambahan
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['draft', 'paid', 'cancelled'])->default('draft');

        $table->decimal('total_amount', 15, 2)->default(0); // Tambahkan ini

        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
