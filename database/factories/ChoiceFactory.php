<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Choice>
 */
class ChoiceFactory extends Factory
{

    private Collection $questions;

    public function __construct($count = null, ?\Illuminate\Support\Collection $states = null, ?\Illuminate\Support\Collection $has = null, ?\Illuminate\Support\Collection $for = null, ?\Illuminate\Support\Collection $afterMaking = null, ?\Illuminate\Support\Collection $afterCreating = null, $connection = null, ?\Illuminate\Support\Collection $recycle = null, bool $expandRelationships = true)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle, $expandRelationships);
        $this->questions = Question::all();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $question = $this->questions->random();
        return [
            'question_id' => $question->id,
            'text' => $this->faker->realText($maxNbChars = 100, $indexSize = 2),
            'is_correct' => $this->faker->boolean,
        ];
    }
}
