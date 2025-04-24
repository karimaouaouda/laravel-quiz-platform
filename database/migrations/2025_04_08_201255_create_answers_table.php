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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')
                ->constrained('submissions')
                ->onUpdate('cascade');
            $table->foreignId('question_id')
                ->constrained('questions')
                ->onDelete('cascade');

            $table->foreignId('choice_id')
                ->constrained('choices')
                ->onDelete('cascade');

            $table->integer('answer_duration', unsigned: true)->nullable()->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
