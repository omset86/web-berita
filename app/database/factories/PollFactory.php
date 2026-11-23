<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'question' => fake()->regexify('[A-Za-z0-9]{255}'),
            'description' => fake()->text(),
            'is_active' => fake()->boolean(),
            'allow_multiple' => fake()->boolean(),
            'total_votes' => fake()->randomNumber(),
            'starts_at' => fake()->dateTime(),
            'ends_at' => fake()->dateTime(),
        ];
    }
}
