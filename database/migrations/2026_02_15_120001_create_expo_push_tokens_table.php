<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Stores Expo push tokens per user/device so we can send notifications via Expo Push API.
     */
    public function up(): void
    {
        Schema::create('expo_push_tokens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('token', 255); // ExponentPushToken[xxx]
            $table->string('platform', 20)->nullable(); // ios, android
            $table->string('device_name', 100)->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'token']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expo_push_tokens');
    }
};
