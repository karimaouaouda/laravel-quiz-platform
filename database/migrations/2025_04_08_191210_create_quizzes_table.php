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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('code')
                ->unique();
            $table->foreignId('teacher_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');
            $table->enum('status',
                array_map(fn(\App\Enums\QuizStatus $case) => $case->value, \App\Enums\QuizStatus::cases())
            )->default(\App\Enums\QuizStatus::INACTIVE->value);

            $table->string('title');
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
