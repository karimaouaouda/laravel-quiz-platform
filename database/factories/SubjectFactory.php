<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected \Illuminate\Database\Eloquent\Collection $teachers;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null, ?Collection $recycle = null, bool $expandRelationships = true)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle, $expandRelationships);
        $this->teachers = User::query()->where('role', 'teacher')->get();
    }

    public function definition(): array
    {
        return [
            'teacher_id' => $this->teachers->random()->id,
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(),
        ];
    }
}
