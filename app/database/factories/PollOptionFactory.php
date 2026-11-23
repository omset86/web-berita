<?php

namespace Database\Factories;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\Factory;

class PollOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'poll_id' => Poll::factory(),
            'label' => fake()->regexify('[A-Za-z0-9]{255}'),
            'vote_count' => fake()->randomNumber(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
