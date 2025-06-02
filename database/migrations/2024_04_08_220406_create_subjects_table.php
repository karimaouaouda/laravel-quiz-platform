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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('name');
            $table->mediumText('description')
                ->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('subjects')->insert([
            ['teacher_id' => 1, 'name' => 'Maths', 'description' => 'Maths description'],
            ['teacher_id' => 1, 'name' => 'Physics', 'description' => 'Physics description'],
            ['teacher_id' => 1, 'name' => 'Chemistry', 'description' => 'Chemistry description'],
            ['teacher_id' => 1, 'name' => 'English', 'description' => 'English description'],
            ['teacher_id' => 1, 'name' => 'French', 'description' => 'French description'],
            ['teacher_id' => 1, 'name' => 'Spanish', 'description' => 'Spanish description'],
            ['teacher_id' => 1, 'name' => 'Arabic', 'description' => 'Arabic description'],
            ['teacher_id' => 1, 'name' => 'computer science', 'description' => 'computer science description'],
            ['teacher_id' => 1, 'name' => 'history', 'description' => 'history description'],
            ['teacher_id' => 1, 'name' => 'geography', 'description' => 'geography description'],
            ['teacher_id' => 1, 'name' => 'politics', 'description' => 'politics description'],
            ['teacher_id' => 1, 'name' => 'economics', 'description' => 'economics description'],
            ['teacher_id' => 1, 'name' => 'biology', 'description' => 'biology description'],
            ['teacher_id' => 1, 'name' => 'scientific writing', 'description' => 'scientific writing description'],
            ['teacher_id' => 1, 'name' => 'art', 'description' => 'art description'],
            ['teacher_id' => 1, 'name' => 'music', 'description' => 'music description'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
