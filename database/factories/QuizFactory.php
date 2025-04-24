<?php

namespace Database\Factories;

use App\Enums\DifficultyLevel;
use App\Enums\QuizStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{

    private \Illuminate\Database\Eloquent\Collection $teachers;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null, ?Collection $recycle = null, bool $expandRelationships = true)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle, $expandRelationships);
        $this->teachers = User::query()->where('role', 'teacher')->get();

    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher = $this->teachers->random();
        $subject = $teacher->subjects->random();
        return [
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'code' => Str::random(10),
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'difficulty_level' => array_rand(DifficultyLevel::toArray(true)),
            'status' => QuizStatus::random()->value,
            'end_at' => now()->addDays(rand(2, 10))
        ];
    }
}
