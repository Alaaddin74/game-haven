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
        //
            DB::statement("ALTER TABLE reward_redemptions MODIFY status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending'");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
