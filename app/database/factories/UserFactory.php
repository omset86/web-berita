<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => fake()->password(),
            'email_verified_at' => fake()->dateTime(),
            'remember_token' => fake()->uuid(),
            'role' => fake()->regexify('[A-Za-z0-9]{50}'),
            'bio' => fake()->text(),
            'avatar' => fake()->regexify('[A-Za-z0-9]{255}'),
            'social_twitter' => fake()->regexify('[A-Za-z0-9]{255}'),
            'social_linkedin' => fake()->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
