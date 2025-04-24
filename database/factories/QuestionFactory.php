<?php

namespace Database\Factories;

use App\Enums\DifficultyLevel;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private \Illuminate\Database\Eloquent\Collection $teachers;
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null, ?Collection $recycle = null, bool $expandRelationships = true)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle, $expandRelationships);
        $this->teachers = User::query()->where('role', 'teacher')->get();
    }

    public function definition(): array
    {
        $teacher = $this->teachers->random();
        return [
            'teacher_id' => $teacher->id,
            'subject_id' => $teacher->subjects->random()->id,
            'text' => $this->faker->realText(),
            'difficulty_level' => array_rand(DifficultyLevel::toArray(true)),
        ];
    }
}
