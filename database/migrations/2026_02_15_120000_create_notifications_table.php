<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Stores notifications for mobile app (title, body, etc.). Sent via Expo Push API.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');
            $table->text('body')->nullable();
            $table->json('data')->nullable(); // custom payload for deep link, etc. (e.g. {"article_id": "..."})
            $table->string('type', 80)->nullable(); // e.g. daily_reminder, best_fact, article

            $table->timestamp('read_at')->nullable();
            $table->timestamp('sent_at')->nullable(); // when successfully sent to Expo
            $table->string('expo_ticket_id', 100)->nullable(); // for receipt lookup

            $table->timestamps();

            $table->index(['user_id', 'read_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
