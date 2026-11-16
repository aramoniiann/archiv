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
        Schema::create('difficulties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('learning_id')
                ->nullable()
                ->constrained('learnings')
                ->nullOnDelete();
            $table->string('subject', 150);
            $table->text('description')->nullable();
            $table->smallInteger('level')->default(3);
            $table->enum('status', ['unresolved', 'studying', 'resolved'])->default('unresolved');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulties');
    }
};
