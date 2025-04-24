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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('copy_id')
                ->constrained('copies')
                ->onDelete('cascade');
            $table->dateTime('loaned_at'); // When borrowed
            $table->dateTime('due_at');    // Due date for return
            $table->dateTime('returned_at')->nullable(); // Actual return date
            $table->timestamps();

            $table->index(['user_id', 'loaned_at']); // For user loan queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
