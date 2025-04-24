<?php

namespace Database\Factories;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = "password123";
    protected bool $karim_created = false;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (! $this->karim_created) {
            $this->karim_created = true;
            return [
                'name' => 'Karim Aouaouda',
                'email' => 'karimaouaouda.officiel@gmail.com',
                'email_verified_at' => now(),
                'role' => UserRoles::TEACHER->value,
                'password' => Hash::make(static::$password??'password'),
                'remember_token' => Str::random(10),
            ];
        }
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => UserRoles::values()[array_rand(UserRoles::values())],
            'password' => Hash::make(static::$password??'password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
