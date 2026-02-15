<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * One row per user: text_size, appearance_mode, daily_reminder_notification, best_fact_notification.
     */
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();

            $table->string('text_size', 20)->default('medium'); // small, medium, large
            $table->string('appearance_mode', 20)->default('system'); // light, dark, system
            $table->boolean('daily_reminder_notification')->default(true);
            $table->boolean('best_fact_notification')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
